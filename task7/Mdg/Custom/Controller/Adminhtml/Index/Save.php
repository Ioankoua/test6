<?php

namespace Mdg\Custom\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Mdg\Custom\Model\Job;
use RuntimeException;

class Save extends Action
{

    /**
     * @var Job
     */
    private $Custommodel;

    /**
     * @var Session
     */
    private $adminsession;

    public function __construct(
        Action\Context $context,
        Job $Custommodel,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->Custommodel = $Custommodel;
        $this->adminsession = $adminsession;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $job_id = $this->getRequest()->getParam('job_id');

            if ($job_id) {
                $this->Custommodel->load($job_id);
            }

            $this->Custommodel->setData($data);

            try {
                $this->Custommodel->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath(
                            '*/*/edit',
                            [
                                'job_id' => $this->Custommodel->getJobId(),
                                '_current' => true
                            ]
                        );
                    }
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['job_id' => $this->getRequest()->getParam('job_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
