<?php

namespace Mdg\Custom\Model;

use Magento\Framework\Model\AbstractModel;
use Mdg\Custom\Model\ResourceModel\Job as JobResourceModel;

class Job extends AbstractModel
{

    protected function _construct()
    {
        $this->_init(JobResourceModel::class);
    }
}
