<?php
declare(strict_types=1);

namespace Ivatsko\RequestPrice\Model;

use Magento\Framework\Model\AbstractModel;
use Ivatsko\RequestPrice\Api\Data\RequestPriceInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Model class RequestPrice
 * @package Ivatsko\RequestPrice\Model
 */
class RequestPrice extends AbstractModel implements RequestPriceInterface, IdentityInterface
{
    const STATUS_NEW = 1;
    const STATUS_PROGRESS = 2;
    const STATUS_CLOSED = 3;

    const CACHE_TAG = 'request_price';

    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ivatsko\RequestPrice\Model\ResourceModel\RequestPrice');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }

    public function getAvailableStatuses()
    {
        return [self::STATUS_NEW => __('New'), self::STATUS_PROGRESS => __('In Progress'), self::STATUS_CLOSED => __('Closed')];
    }

    public function getId()
    {
        return parent::getData(self::ID);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }

    public function setUpdatedAt($updated_at)
    {
        return $this->setData(self::UPDATED_AT, $updated_at);
    }
}
