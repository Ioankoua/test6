<?php

namespace Mdg\Entity\Model\ResourceModel;

use Magento\Eav\Model\Entity\AbstractEntity;

/*
Our resource class extends from \Magento\Eav\Model\Entity\AbstractEntity,
and set $this->_read, $this->_write class properties  in _construct() method
*/
class Employee extends AbstractEntity {
    protected function _construct() {
        $this->_read = 'mdg_employee_read';
        $this->_write = 'mdg+employee_write';
    }

    public function getEntityType() {
        if(empty($this->_type)) {
            $this->setType(\Mdg\Entity\Model\Employee::ENTITY);
        }

        return parent::getEntityType();
    }
}
