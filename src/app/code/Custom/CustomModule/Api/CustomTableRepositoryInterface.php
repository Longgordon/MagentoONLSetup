<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Custom\CustomModule\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * CMS page CRUD interface.
 * @api
 * @since 100.0.2
 */
interface CustomTableRepositoryInterface
{
    /**
     * Save page.
     *
     * @param \Custom\CustomModule\Api\Data\CustomTableInterface $page
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Custom\CustomModule\Api\Data\CustomTableInterface $page);

    /**
     * Retrieve page.
     *
     * @param int $pageId
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($pageId);

    /**
     * Retrieve pages matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Custom\CustomModule\Api\Data\PageSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete page.
     *
     * @param \Custom\CustomModule\Api\Data\CustomTableInterface $page
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Custom\CustomModule\Api\Data\CustomTableInterface $page);

    /**
     * Delete page by ID.
     *
     * @param int $pageId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($pageId);
}
