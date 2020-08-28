<?php
declare(strict_types=1);

namespace Ivatsko\RequestPrice\Ui\Component\Listing\Column;

/**
 * Class RequestPriceStatus
 * @package Ivatsko\RequestPrice\Ui\Component\Listing\Column
 */
class RequestPriceStatus implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('New')],
            ['value' => 2, 'label' => __('In progress')],
            ['value' => 3, 'label' => __('Closed')]
        ];
    }
}
