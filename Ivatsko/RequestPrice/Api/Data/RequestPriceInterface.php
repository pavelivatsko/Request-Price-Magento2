<?php
namespace Ivatsko\RequestPrice\Api\Data;

interface RequestPriceInterface
{
    const ID = 'records_id';
    const NAME = 'name';
    const EMAIL = 'email';
    const COMMENT = 'comment';
    const SKU = 'product_sku';
    const STATUS = 'status_id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getId();

    public function getName();

    public function getEmail();

    public function getComment();

    public function getSku();

    public function getStatus();

    public function getCreatedAt();

    public function getUpdatedAt();

    public function setId($id);

    public function setName($name);

    public function setEmail($email);

    public function setComment($comment);

    public function setSku($sku);

    public function setStatus($status);

    public function setCreatedAt($created_at);

    public function setUpdatedAt($updated_at);
}

?>
