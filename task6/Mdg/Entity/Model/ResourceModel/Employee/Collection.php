<?php

namespace Mdg\Entity\Model\ResourceModel\Employee;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;

class Collection extends AbstractCollection {
    protected function _construct() {
        /* Full model classname, full resource classname */
        $this->_init(
            'Mdg\Entity\Model\Employee',
            'Mdg\Office\Model\ResourceModel\Employee');
    }
}
