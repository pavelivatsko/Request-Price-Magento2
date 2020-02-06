<?php
declare(strict_types=1);

namespace Ivatsko\RequestPrice\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Resource model class RequestPrice
 * @package Ivatsko\RequestPrice\Model\ResourceModel
 */
class RequestPrice extends AbstractDb
{
    protected $date;
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateConstruct
    ) {
        parent::__construct($context);
        $this->date = $dateConstruct;
    }
    /**
     * Initialize db table
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('request_price', 'records_id');
    }

    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $object->setUpdatedAt($this->date->date());
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->date->date());
        }
        return parent::_beforeSave($object);
    }
}
