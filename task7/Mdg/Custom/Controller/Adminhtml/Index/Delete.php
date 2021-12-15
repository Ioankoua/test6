<?php

namespace Mdg\Custom\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Mdg\Custom\Model\Job;

class Delete extends Action
{

    /**
     * @var Job
     */
    private $modelJob;

    /**
     * @param Action\Context $context
     * @param Job $model
     */
    public function __construct(
        Action\Context $context,
        Job $model
    ) {
        parent::__construct($context);
        $this->modelJob = $model;
    }

    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('job_id');

        /**
         * @var Redirect $resultRedirect
         */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->modelJob;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Record deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Record does not exist'));
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Mdg_Custom::index_delete');
    }
}
