<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Custom\CustomModule\Api\Data;

/**
 * CMS page interface.
 * @api
 * @since 100.0.2
 */
interface CustomTableInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const PAGE_ID                  = 'page_id';
    const IDENTIFIER               = 'identifier';
    const TITLE                    = 'title';
    const PAGE_LAYOUT              = 'page_layout';
    const META_TITLE               = 'meta_title';
    const META_KEYWORDS            = 'meta_keywords';
    const META_DESCRIPTION         = 'meta_description';
    const CONTENT_HEADING          = 'content_heading';
    const CONTENT                  = 'content';
    const CREATION_TIME            = 'creation_time';
    const UPDATE_TIME              = 'update_time';
    const SORT_ORDER               = 'sort_order';
    const LAYOUT_UPDATE_XML        = 'layout_update_xml';
    const CUSTOM_THEME             = 'custom_theme';
    const CUSTOM_ROOT_TEMPLATE     = 'custom_root_template';
    const CUSTOM_LAYOUT_UPDATE_XML = 'custom_layout_update_xml';
    const CUSTOM_THEME_FROM        = 'custom_theme_from';
    const CUSTOM_THEME_TO          = 'custom_theme_to';
    const IS_ACTIVE                = 'is_active';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get page layout
     *
     * @return string|null
     */
    public function getPageLayout();

    /**
     * Get meta title
     *
     * @return string|null
     * @since 101.0.0
     */
    public function getMetaTitle();

    /**
     * Get meta keywords
     *
     * @return string|null
     */
    public function getMetaKeywords();

    /**
     * Get meta description
     *
     * @return string|null
     */
    public function getMetaDescription();

    /**
     * Get content heading
     *
     * @return string|null
     */
    public function getContentHeading();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Get sort order
     *
     * @return string|null
     */
    public function getSortOrder();

    /**
     * Get layout update xml
     *
     * @return string|null
     * @deprecated 103.0.4 Existing updates are applied, new are not accepted.
     */
    public function getLayoutUpdateXml();

    /**
     * Get custom theme
     *
     * @return string|null
     */
    public function getCustomTheme();

    /**
     * Get custom root template
     *
     * @return string|null
     */
    public function getCustomRootTemplate();

    /**
     * Get custom layout update xml
     *
     * @deprecated 103.0.4 Existing updates are applied, new are not accepted.
     * @see \Custom\CustomModule\Model\Page\CustomLayout\Data\CustomLayoutSelectedInterface
     * @return string|null
     */
    public function getCustomLayoutUpdateXml();

    /**
     * Get custom theme from
     *
     * @return string|null
     */
    public function getCustomThemeFrom();

    /**
     * Get custom theme to
     *
     * @return string|null
     */
    public function getCustomThemeTo();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * Set ID
     *
     * @param int $id
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setId($id);

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setIdentifier($identifier);

    /**
     * Set title
     *
     * @param string $title
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setTitle($title);

    /**
     * Set page layout
     *
     * @param string $pageLayout
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setPageLayout($pageLayout);

    /**
     * Set meta title
     *
     * @param string $metaTitle
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     * @since 101.0.0
     */
    public function setMetaTitle($metaTitle);

    /**
     * Set meta keywords
     *
     * @param string $metaKeywords
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * Set meta description
     *
     * @param string $metaDescription
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setMetaDescription($metaDescription);

    /**
     * Set content heading
     *
     * @param string $contentHeading
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setContentHeading($contentHeading);

    /**
     * Set content
     *
     * @param string $content
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setContent($content);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set sort order
     *
     * @param string $sortOrder
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setSortOrder($sortOrder);

    /**
     * Set layout update xml
     *
     * @param string $layoutUpdateXml
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     * @deprecated 103.0.4 Existing updates are applied, new are not accepted.
     */
    public function setLayoutUpdateXml($layoutUpdateXml);

    /**
     * Set custom theme
     *
     * @param string $customTheme
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setCustomTheme($customTheme);

    /**
     * Set custom root template
     *
     * @param string $customRootTemplate
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setCustomRootTemplate($customRootTemplate);

    /**
     * Set custom layout update xml
     *
     * @param string $customLayoutUpdateXml
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     * @deprecated 103.0.4 Existing updates are applied, new are not accepted.
     * @see \Custom\CustomModule\Model\Page\CustomLayout\Data\CustomLayoutSelectedInterface
     */
    public function setCustomLayoutUpdateXml($customLayoutUpdateXml);

    /**
     * Set custom theme from
     *
     * @param string $customThemeFrom
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setCustomThemeFrom($customThemeFrom);

    /**
     * Set custom theme to
     *
     * @param string $customThemeTo
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setCustomThemeTo($customThemeTo);

    /**
     * Set is active
     *
     * @param int|bool $isActive
     * @return \Custom\CustomModule\Api\Data\CustomTableInterface
     */
    public function setIsActive($isActive);
}
