<?php

namespace Ivatsko\RequestPrice\Controller\Adminhtml\AllRecords;

use Magento\Backend\App\Action;
use Ivatsko\RequestPrice\Model\RequestPrice;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Ivatsko\RequestPrice\Model\RequestPriceFactory
     */
    private $requestPriceFactory;

    /**
     * @var \Ivatsko\RequestPrice\Api\RequestPriceRepositoryInterface
     */
    private $requestPriceRepository;

    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \Ivatsko\RequestPrice\Model\RequestPriceFactory $requestPriceFactoryConstruct = null,
        \Ivatsko\RequestPrice\Api\RequestPriceRepositoryInterface $requestPriceRepositoryConstruct = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->requestPriceFactory = $requestPriceFactoryConstruct
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Ivatsko\RequestPrice\Model\RequestPriceFactory::class);
        $this->requestPriceRepository = $requestPriceRepositoryConstruct
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Ivatsko\RequestPrice\Api\RequestPriceRepositoryInterface::class);
        parent::__construct($context);
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
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['status_id']) && $data['status_id'] === 'true') {
                $data['status_id'] = RequestPrice::STATUS_NEW;
            }
            if (empty($data['records_id'])) {
                $data['records_id'] = null;
            }

            /** @var  \Ivatsko\RequestPrice\Model\RequestPrice $model */
            $model = $this->requestPriceFactory->create();

            $id = $this->getRequest()->getParam('records_id');
            if ($id) {
                try {
                    $model = $this->requestPriceRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This news no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'records_allrecords_prepare_save',
                ['allrecords' => $model, 'request' => $this->getRequest()]
            );

            try {
                $this->requestPriceRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the records.'));
                $this->dataPersistor->clear('records_allrecords');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['records_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?:$e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the records.'));
            }

            $this->dataPersistor->set('records_allrecords', $data);
            return $resultRedirect->setPath('*/*/edit', ['records_id' => $this->getRequest()->getParam('records_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
?>
