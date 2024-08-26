<?php

namespace Custom\CustomModule\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Zend_Db_Exception;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @inheritdoc
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
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

    /**
     * Create the braintree_transaction_details table
     *
     * @param SchemaSetupInterface $installer
     * @throws Zend_Db_Exception
     */
    private function braintreeTransactionDetails(SchemaSetupInterface $installer)
    {
        /**
         * Create table 'braintree_transaction_details'
         */
        $connection = $installer->getConnection('sales');
        $table = $connection
            ->newTable($installer->getTable('braintree_transaction_details'))
            ->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity ID'
            )
            ->addColumn(
                'order_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Order Id'
            )
            ->addColumn(
                'transaction_source',
                Table::TYPE_TEXT,
                12,
                ['nullable' => true],
                'Transaction Source'
            )
            ->addIndex(
                $installer->getIdxName('braintree_transaction_details', ['order_id']),
                ['order_id']
            )
            ->addForeignKey(
                $installer->getFkName('braintree_transaction_details', 'order_id', 'sales_order', 'entity_id'),
                'order_id',
                $installer->getTable('sales_order'),
                'entity_id',
                Table::ACTION_CASCADE
            )
            ->setComment('Braintree transaction details table');
        $connection->createTable($table);
    }
}
