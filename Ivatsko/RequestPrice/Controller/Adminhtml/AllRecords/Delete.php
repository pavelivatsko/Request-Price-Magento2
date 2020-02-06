<?php

namespace Ivatsko\RequestPrice\Controller\Adminhtml\AllRecords;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level
     *
     * @see _isAllowed()
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ivatsko_RequestPrice::records_delete');
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('records_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Ivatsko\RequestPrice\Model\RequestPrice::class);
                $model->load($id);
                $name = $model->getName();
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('The records has been deleted.'));
                // go to grid
                $this->_eventManager->dispatch(
                    'adminhtml_records_on_delete',
                    ['name' => $name, 'status' => 'success']
                );
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_records_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['records_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a records to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
?>
