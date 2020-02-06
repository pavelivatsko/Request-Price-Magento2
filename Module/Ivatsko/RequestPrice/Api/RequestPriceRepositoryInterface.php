<?php
namespace Ivatsko\RequestPrice\Api;

interface RequestPriceRepositoryInterface
{
    public function save(\Ivatsko\RequestPrice\Api\Data\RequestPriceInterface $records);

    public function getById($recordId);

    public function delete(\Ivatsko\RequestPrice\Api\Data\RequestPriceInterface $records);

    public function deleteById($recordId);
}
?>
