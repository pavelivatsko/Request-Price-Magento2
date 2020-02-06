<?php
declare(strict_types=1);

namespace Ivatsko\RequestPrice\Model\ResourceModel\RequestPrice;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Model RequestPriceStatusCollection Collection
 * @package Ivatsko\RequestPrice\Model\ResourceModel\RequestPriceStatusCollection
 */
class RequestPriceStatusCollection extends AbstractCollection
{
    /**
     * Initialize Model and ResourceModel
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ivatsko\RequestPrice\Model\RequestPriceStatus', 'Ivatsko\RequestPrice\Model\ResourceModel\RequestPriceStatus');
    }
}
