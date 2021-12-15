<?php


namespace Mdg\Custom\Model\ResourceModel\Job;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mdg\Custom\Model\Job;
use Mdg\Custom\Model\ResourceModel\Job as JobResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Job::class, JobResourceModel::class);
    }
}
