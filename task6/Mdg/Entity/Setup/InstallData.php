<?php

namespace Mdg\Entity\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Product;


class InstallData implements InstallDataInterface {

    private EavSetup $eavSetup;

    private $employeeSetupFactory;

    public function __construct(
        \Mdg\Entity\Setup\EmployeeSetupFactory $employeeSetupFactory,
        \Magento\Eav\Model\Config $eavConfig,
    ) {
        $this->employeeSetupFactory = $employeeSetupFactory;
        $this->eavConfig = $eavConfig;
    }


    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();

        $employeeEntity = \Mdg\Entity\Model\Employee::ENTITY;

        $employeeSetup = $this->employeeSetupFactory->create(['setup' => $setup]);

        $employeeSetup->installEntities();


        $employeeSetup->addAttribute(
            $employeeEntity, 'service_years', ['type' => 'int']
        );

        $employeeSetup->addAttribute(
            $employeeEntity, 'dob', ['type' => 'datetime']
        );

        $employeeSetup->addAttribute(
            $employeeEntity, 'salary', ['type' => 'decimal']
        );

        $employeeSetup->addAttribute(
            $employeeEntity, 'vat_number', ['type' => 'varchar']
        );

        $employeeSetup->addAttribute(
            $employeeEntity, 'not', ['type' => 'text']
        );

        $setup->endSetup();
    }

    public function gerAtributValues()
    {
        $employeeEntity = \Mdg\Entity\Model\Employee::ENTITY;
        $attribute = $this->eavConfig->getAttribute('mdg_employee', 'salary');
        $options = $attribute->getSource()->getAllOptions();
        $this->eavSetup->removeAttribute($employeeEntity, $options[0]);
    }

}
