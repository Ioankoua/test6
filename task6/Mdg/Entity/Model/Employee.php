<?php

namespace Mdg\Entity\Model;

use Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel {
    const ENTITY = 'mdg_employee';

    protected function _construct() {
        /* full resource classname */
        $this->_init('Mdg\Entity\Model\ResourceModel\Employee');
    }
}
