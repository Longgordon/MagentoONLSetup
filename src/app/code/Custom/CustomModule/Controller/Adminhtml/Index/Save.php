<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Custom\CustomModule\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Custom\CustomModule\Api\Data\CustomTableInterface;
use Custom\CustomModule\Api\CustomTableRepositoryInterface;
use Custom\CustomModule\Model\CustomTable;
use Custom\CustomModule\Model\CustomTableFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Save CMS page action.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Custom_CustomModule::save';

    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var CustomTableFactory
     */
    private $customTableFactory;

    /**
     * @var CustomTableRepositoryInterface
     */
    private $pageRepository;

    /**
     * @param Action\Context $context
     * @param PostDataProcessor $dataProcessor
     * @param DataPersistorInterface $dataPersistor
     * @param CustomTableFactory|null $customTableFactory
     * @param CustomTableRepositoryInterface|null $pageRepository
     */
    public function __construct(
        Action\Context $context,
        PostDataProcessor $dataProcessor,
        DataPersistorInterface $dataPersistor,
        CustomTableFactory $customTableFactory = null,
        CustomTableRepositoryInterface $pageRepository = null
    ) {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        $this->customTableFactory = $customTableFactory ?: ObjectManager::getInstance()->get(CustomTableFactory::class);
        $this->pageRepository = $pageRepository ?: ObjectManager::getInstance()->get(CustomTableRepositoryInterface::class);
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data = $this->dataProcessor->filter($data);
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = CustomTable::STATUS_ENABLED;
            }
            if (empty($data['id_custom'])) {
                $data['id_custom'] = null;
            }

            /** @var CustomTable $model */
            $model = $this->customTableFactory->create();

            $id = $this->getRequest()->getParam('id_custom');
            if ($id) {
                try {
                    $model = $this->pageRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This page no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $data['layout_update_xml'] = $model->getLayoutUpdateXml();
            $data['custom_layout_update_xml'] = $model->getCustomLayoutUpdateXml();
            $model->setData($data);

            try {
                // $this->_eventManager->dispatch(
                //     'custom_table_prepare_save',
                //     ['page' => $model, 'request' => $this->getRequest()]
                // );

                $this->pageRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the page.'));
                return $this->processResultRedirect($model, $resultRedirect, $data);
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Throwable $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the page.'));
            }

            $this->dataPersistor->set('custom_table', $data);
            return $resultRedirect->setPath('*/*/edit', ['id_custom' => $this->getRequest()->getParam('id_custom')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process result redirect
     *
     * @param CustomTableInterface $model
     * @param Redirect $resultRedirect
     * @param array $data
     * @return Redirect
     * @throws LocalizedException
     */
    private function processResultRedirect($model, $resultRedirect, $data)
    {
        if ($this->getRequest()->getParam('back', false) === 'duplicate') {
            $newCustomTable = $this->customTableFactory->create(['data' => $data]);
            $newCustomTable->setId(null);
            $identifier = $model->getIdentifier() . '-' . uniqid();
            $newCustomTable->setIdentifier($identifier);
            $newCustomTable->setIsActive(false);
            $this->pageRepository->save($newCustomTable);
            $this->messageManager->addSuccessMessage(__('You duplicated the page.'));
            return $resultRedirect->setPath(
                '*/*/edit',
                [
                    'id_custom' => $newCustomTable->getId(),
                    '_current' => true,
                ]
            );
        }
        $this->dataPersistor->clear('custom_table');
        if ($this->getRequest()->getParam('back')) {
            return $resultRedirect->setPath('*/*/edit', ['id_custom' => $model->getId(), '_current' => true]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
