<?php

namespace Custom\CustomModule\Model\CustomTable\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Custom\CustomModule\Model\CustomTable;

class Status implements OptionSourceInterface
{

    protected $custom_tale;

    public function __construct(CustomTable $custom_tale)
    {
        $this->custom_tale = $custom_tale;
    }

    /**
     * Get status options
     */
    public function toOptionArray()
    {
        $availableOptions = $this->custom_tale->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
