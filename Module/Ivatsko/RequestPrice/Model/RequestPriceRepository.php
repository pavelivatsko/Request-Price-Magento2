<?php

namespace Ivatsko\RequestPrice\Model;

use Ivatsko\RequestPrice\Api\Data;
use Ivatsko\RequestPrice\Api\RequestPriceRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Ivatsko\RequestPrice\Model\ResourceModel\RequestPrice as ResourceRequestPrice;
use Ivatsko\RequestPrice\Model\ResourceModel\RequestPrice\RequestPriceCollectionFactory as RequestPriceCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class RequestPriceRepository implements RequestPriceRepositoryInterface
{
    protected $resource;

    protected $requestPriceFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataRequestPriceFactory;

    private $storeManager;

    public function __construct(
        ResourceRequestPrice $resource,
        RequestPriceFactory $requestPriceFactory,
        Data\RequestPriceInterfaceFactory $dataRequestPriceFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->requestPriceFactory = $requestPriceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataRequestPriceFactory = $dataRequestPriceFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    public function save(\Ivatsko\RequestPrice\Api\Data\RequestPriceInterface $records)
    {
        if ($records->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $records->setStoreId($storeId);
        }
        try {
            $this->resource->save($records);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the records: %1', $exception->getMessage()),
                $exception
            );
        }
        return $records;
    }

    public function getById($recordsId)
    {
        $records = $this->requestPriceFactory->create();
        $records->load($recordsId);
        if (!$records->getId()) {
            throw new NoSuchEntityException(__('Records with id "%1" does not exist.', $recordsId));
        }
        return $records;
    }

    public function delete(\Ivatsko\RequestPrice\Api\Data\RequestPriceInterface $records)
    {
        try {
            $this->resource->delete($records);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the records: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($recordsId)
    {
        return $this->delete($this->getById($recordsId));
    }
}
?>
