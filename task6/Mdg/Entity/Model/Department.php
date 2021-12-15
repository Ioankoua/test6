<?php

namespace Mdg\Entity\Model;

use Magento\Framework\Model\AbstractModel;

class Department extends AbstractModel {
    protected function _construct() {
        /* full resource classname */
        $this->_init('Mdg\Entity\Model\ResourceModel\Department');
    }
}
