<?php

namespace Mdg\Entity\Model\ResourceModel\Department;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {
    protected function _construct() {
        $this->_init('Mdg\Entity\Model\Department', 'Mdg\Entity\Model\ResourceModel\Department');
    }
}
