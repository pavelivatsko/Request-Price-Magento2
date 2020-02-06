<?php
namespace Ivatsko\RequestPrice\Controller\Adminhtml\AllRecords;

use Magento\Backend\App\Action\Context;
use Ivatsko\RequestPrice\Api\RequestPriceRepositoryInterface as RequestPriceRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use Ivatsko\RequestPrice\Api\Data\RequestPriceInterface;

class InlineEdit extends \Magento\Backend\App\Action
{
    protected $requestPriceRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    public function __construct(
        Context $context,
        RequestPriceRepository $requestPriceRepositoryConstruct,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->requestPriceRepository = $requestPriceRepositoryConstruct;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * Authorization level
     *
     * @see _isAllowed()
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ivatsko_RequestPrice::save');
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($postItems) as $recordsId) {
            $records = $this->requestPriceRepository->getById($recordsId);
            try {
                $recordsData = $postItems[$recordsId];
                $extendedNewsData = $records->getData();
                $this->setRecordsData($records, $extendedNewsData, $recordsData);
                $this->requestPriceRepository->save($records);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithRecordsId($records, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithRecordsId($records, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithRecordsId(
                    $records,
                    __('Something went wrong while saving the records.')
                );
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    protected function getErrorWithRecordsId(RequestPriceInterface $records, $errorText)
    {
        return '[Records ID: ' . $records->getId() . '] ' . $errorText;
    }

    public function setRecordsData(\Ivatsko\RequestPrice\Model\RequestPrice $records, array $extendedRecordData, array $recordsData)
    {
        $records->setData(array_merge($records->getData(), $extendedRecordData, $recordsData));
        return $this;
    }
}
?>
