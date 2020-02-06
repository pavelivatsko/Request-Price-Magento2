<?php
namespace Ivatsko\RequestPrice\Controller\Adminhtml\AllRecords;

use Magento\Backend\App\Action;
use Ivatsko\RequestPrice\Model\RequestPrice as RequestPriceModel;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
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
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\RequestPrice
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Allrecords $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ivatsko_RequestPrice::records_allrecords')
            ->addBreadcrumb(__('Records'), __('Records'))
            ->addBreadcrumb(__('Manage All Records'), __('Manage All Records'));
        return $resultPage;
    }

    /**
     * Edit Allnews
     *
     * @return \Magento\Backend\Model\View\Result\RequestPrice|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('records_id');
        $model = $this->_objectManager->create(RequestPriceModel::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This records no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('records_allrecords', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Allrecords $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Records') : __('Add Records'),
            $id ? __('Edit Records') : __('Add Records')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Allrecords'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('Add Records'));

        return $resultPage;
    }
}
?>
