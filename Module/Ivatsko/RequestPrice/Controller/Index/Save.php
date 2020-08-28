<?php
declare(strict_types=1);

namespace Ivatsko\RequestPrice\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Ivatsko\RequestPrice\Model\RequestPriceFactory;

/**
 * Class Save
 * @package Ivatsko\RequestPrice\Controller\Index
 */
class Save extends Action
{

    /**
     * @var RequestPriceFactory
     */
    protected $requestPriceFactory;

    /**
     * Save constructor.
     * @param Context $context
     * @param RequestPriceFactory $requestPriceFactoryConstruct
     */
    public function __construct(
        Context $context,
        RequestPriceFactory $requestPriceFactoryConstruct
    )
    {
        parent::__construct($context);
        $this->requestPriceFactory = $requestPriceFactoryConstruct;
    }

    public function execute()
    {
        $requestData = $this->getRequest()->getPost();
        $requestPriceModel = $this->requestPriceFactory->create();
        if (!filter_var($requestData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->messageManager->addErrorMessage(__("Error, please enter correct Email data"));
            return;
        }
        if (empty($requestData['name']) || empty($requestData['email'])) {
            $this->messageManager->addErrorMessage(__("Error, please enter data"));
            return;
        } else {
            $requestPriceModel->setData('name', $requestData['name']);
            $requestPriceModel->setData('email',  $requestData['email']);
            $requestPriceModel->setData('comment',  $requestData['comment']);
            $requestPriceModel->setData('product_sku', $requestData['product_sku']);
        }
        $requestPriceModel->save();

        $this->messageManager->addSuccess(__('Request added.'));
    }
}
