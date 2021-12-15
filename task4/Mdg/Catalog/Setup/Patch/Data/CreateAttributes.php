<?php

declare(strict_types=1);

namespace Mdg\Catalog\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;

class CreateAttributes implements DataPatchInterface, PatchRevertableInterface, PatchVersionInterface
{
    private EavSetup $eavSetup;

    private ModuleDataSetupInterface $moduleDataSetup;

    public function __construct(EavSetupFactory $eavSetupFactory, ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->eavSetup = $eavSetupFactory->create(['setup' => $moduleDataSetup]);
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $this->eavSetup->addAttribute(
            Product::ENTITY,
            'mdg_type_text',
            [
                'attribute_set' => 'Default',
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Mdg type text',
                'input' => 'text',
                'required' => false,
                'sort_order' => 50,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'is_used_in_grid' => true,
                'is_filterable_in_grid' => true,
                'is_visible_in_grid' => true,
                'visible_on_front' => true,
                'is_html_allowed_on_front' => true,
            ]
        );

        $this->eavSetup->addAttribute(
            Product::ENTITY,
            'mdg_type_select',
            [
                'attribute_set' => 'Default',
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Mdg type select',
                'input' => 'select',
                'required' => false,
                'sort_order' => 50,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => true,
                'visible_on_front' => true,
                'is_html_allowed_on_front' => false,
                'option' => [
                    'values' => [
                        'option1',
                        'option2',
                        'option3',
                    ],
                ],
                'default' => 'whatever',
            ]
        );

        $this->eavSetup->addAttribute(
            Product::ENTITY,
            'mdg_type_multi',
            [
                'attribute_set' => 'Default',
                'type' => 'varchar',
                'group' => 'General',
                'label' => 'Mdg type multi',
                'input' => 'multiselect',
                'required' => false,
                'sort_order' => 50,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'backend' => ArrayBackend::class,
                'visible' => true,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible_on_front' => true,
                'is_html_allowed_on_front' => false,
                'option' => [
                    'values' => [
                        'abc1',
                        'abc2',
                        'abc3',
                    ],
                ],
            ]
        );
    }

    public function revert()
    {
        $this->eavSetup->removeAttribute(Product::ENTITY, 'mdg_type_text');
        $this->eavSetup->removeAttribute(Product::ENTITY, 'mdg_type_select');
        $this->eavSetup->removeAttribute(Product::ENTITY, 'mdg_type_multi');
    }

    public static function getVersion()
    {
        return '1.0.2';
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
