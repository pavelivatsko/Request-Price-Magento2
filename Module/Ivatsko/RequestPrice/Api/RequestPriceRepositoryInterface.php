<?php
namespace Ivatsko\RequestPrice\Api;

/**
 * Interface RequestPriceRepositoryInterface
 * @package Ivatsko\RequestPrice\Api
 */
interface RequestPriceRepositoryInterface
{
    /**
     * @param Data\RequestPriceInterface $records
     * @return mixed
     */
    public function save(\Ivatsko\RequestPrice\Api\Data\RequestPriceInterface $records);

    /**
     * @param $recordId
     * @return mixed
     */
    public function getById($recordId);

    /**
     * @param Data\RequestPriceInterface $records
     * @return mixed
     */
    public function delete(\Ivatsko\RequestPrice\Api\Data\RequestPriceInterface $records);

    /**
     * @param $recordId
     * @return mixed
     */
    public function deleteById($recordId);
}
?>
