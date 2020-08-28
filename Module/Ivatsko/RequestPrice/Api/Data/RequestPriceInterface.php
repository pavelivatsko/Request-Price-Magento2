<?php

namespace Ivatsko\RequestPrice\Api\Data;

/**
 * Interface RequestPriceInterface
 * @package Ivatsko\RequestPrice\Api\Data
 */
interface RequestPriceInterface
{
    /**
     *
     */
    const ID = 'records_id';
    /**
     *
     */
    const NAME = 'name';
    /**
     *
     */
    const EMAIL = 'email';
    /**
     *
     */
    const COMMENT = 'comment';
    /**
     *
     */
    const SKU = 'product_sku';
    /**
     *
     */
    const STATUS = 'status_id';
    /**
     *
     */
    const CREATED_AT = 'created_at';
    /**
     *
     */
    const UPDATED_AT = 'updated_at';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @return mixed
     */
    public function getComment();

    /**
     * @return mixed
     */
    public function getSku();

    /**
     * @return mixed
     */
    public function getStatus();

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @return mixed
     */
    public function getUpdatedAt();

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id);

    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * @param $email
     * @return mixed
     */
    public function setEmail($email);

    /**
     * @param $comment
     * @return mixed
     */
    public function setComment($comment);

    /**
     * @param $sku
     * @return mixed
     */
    public function setSku($sku);

    /**
     * @param $status
     * @return mixed
     */
    public function setStatus($status);

    /**
     * @param $created_at
     * @return mixed
     */
    public function setCreatedAt($created_at);

    /**
     * @param $updated_at
     * @return mixed
     */
    public function setUpdatedAt($updated_at);
}

?>
