<?php
declare(strict_types=1);

namespace Ivatsko\RequestPrice\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Resource model class RequestPriceStatus
 * @package Ivatsko\RequestPrice\Model\ResourceModel
 */
class RequestPriceStatus extends AbstractDb
{
    /**
     * Initialize db table
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('request_price_status', 'id');
    }
}
