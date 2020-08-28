<?php
declare(strict_types=1);

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

/**
 * Class RequestPriceRepository
 * @package Ivatsko\RequestPrice\Model
 */
class RequestPriceRepository implements RequestPriceRepositoryInterface
{
    /**
     * @var ResourceRequestPrice
     */
    protected $resource;

    /**
     * @var RequestPriceFactory
     */
    protected $requestPriceFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var Data\RequestPriceInterfaceFactory
     */
    protected $dataRequestPriceFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * RequestPriceRepository constructor.
     * @param ResourceRequestPrice $resource
     * @param RequestPriceFactory $requestPriceFactory
     * @param Data\RequestPriceInterfaceFactory $dataRequestPriceFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
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

    /**
     * @param Data\RequestPriceInterface $records
     * @return Data\RequestPriceInterface|mixed
     */
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

    /**
     * @param $recordsId
     * @return mixed
     */
    public function getById($recordsId)
    {
        $records = $this->requestPriceFactory->create();
        $records->load($recordsId);
        if (!$records->getId()) {
            throw new NoSuchEntityException(__('Records with id "%1" does not exist.', $recordsId));
        }
        return $records;
    }

    /**
     * @param Data\RequestPriceInterface $records
     * @return bool|mixed
     */
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

    /**
     * @param $recordsId
     * @return bool|mixed
     */
    public function deleteById($recordsId)
    {
        return $this->delete($this->getById($recordsId));
    }
}
?>
