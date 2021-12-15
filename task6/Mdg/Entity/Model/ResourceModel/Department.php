<?php

namespace Mdg\Entity\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Department extends AbstractDb {
    protected function _construct() {
        /* tablename, primarykey*/
        $this->_init('mdg_department', 'id');
    }
}
