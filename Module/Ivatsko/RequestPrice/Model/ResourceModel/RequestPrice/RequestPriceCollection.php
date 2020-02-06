<?php
declare(strict_types=1);

namespace Ivatsko\RequestPrice\Model\ResourceModel\RequestPrice;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Model RequestPriceCollection Collection
 * @package Ivatsko\RequestPrice\Model\ResourceModel\RequestPriceCollection
 */
class RequestPriceCollection extends AbstractCollection
{
    protected $_idFieldName = 'records_id';

    protected $_eventPrefix = 'records_allrecords_collection';

    protected $_eventObject = 'allrecords_collection';
    /**
     * Initialize Model and ResourceModel
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ivatsko\RequestPrice\Model\RequestPrice', 'Ivatsko\RequestPrice\Model\ResourceModel\RequestPrice');
    }
}
