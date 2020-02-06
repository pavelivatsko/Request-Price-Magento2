<?php
namespace Ivatsko\RequestPrice\Model\RequestPrice;

use Ivatsko\RequestPrice\Model\RequestPrice;
use Ivatsko\RequestPrice\Model\RequestPriceFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /**
     * @var \Ivatsko\RequestPrice\Model\ResourceModel\RequestPrice\RequestPriceCollection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;


    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param RequestPriceFactory $recordCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        RequestPriceFactory $recordCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $recordCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var $records \Ivatsko\RequestPrice\Model\RequestPrice */
        foreach ($items as $records) {
            $this->loadedData[$records->getId()] = $records->getData();
        }

        $data = $this->dataPersistor->get('records_allrecords');
        if (!empty($data)) {
            $records = $this->collection->getNewEmptyItem();
            $records->setData($data);
            $this->loadedData[$records->getId()] = $records->getData();
            $this->dataPersistor->clear('records_allrecords');
        }

        return $this->loadedData;
    }
}
