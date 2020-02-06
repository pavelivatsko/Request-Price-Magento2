<?php
declare(strict_types=1);

namespace Ivatsko\RequestPrice\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Model class RequestPriceStatus
 * @package Ivatsko\RequestPrice\Model
 */
class RequestPriceStatus extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct() {
        $this->_init('Ivatsko\RequestPrice\Model\ResourceModel\RequestPriceStatus');
    }
}
