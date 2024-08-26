<?php

namespace Custom\CustomModule\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $connection = $setup->getConnection();
        $customTable = $setup->getTable('custom_table');

        if ($connection->isTableExists($customTable)) : exit;
        endif;

        $table = $connection->newTable("custom_table")
            ->addColumn(
                "id_custom",
                Table::TYPE_INTEGER,
                null,
                ["identity" => true, "unsigned" => true, "nullable" => false, "primary" => true],
                "ID"
            )
            ->addColumn(
                "name_custom",
                Table::TYPE_TEXT,
                255,
                ["nullable" => false]
            )
            ->setOption("charset", "utf8");
        $connection->createTable($table);

        $setup->endSetup();
    }
}
