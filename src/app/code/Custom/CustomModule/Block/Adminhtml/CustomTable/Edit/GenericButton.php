<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Custom\CustomModule\Block\Adminhtml\CustomTable\Edit;

use Magento\Backend\Block\Widget\Context;
use Custom\CustomModule\Api\CustomTableRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var CustomTableRepositoryInterface
     */
    protected $pageRepository;

    /**
     * @param Context $context
     * @param CustomTableRepositoryInterface $pageRepository
     */
    public function __construct(
        Context $context,
        CustomTableRepositoryInterface $pageRepository
    ) {
        $this->context = $context;
        $this->pageRepository = $pageRepository;
    }

    /**
     * Return CMS page ID
     *
     * @return int|null
     */
    public function getPageId()
    {
        try {
            return $this->pageRepository->getById(
                $this->context->getRequest()->getParam('id_custom')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
