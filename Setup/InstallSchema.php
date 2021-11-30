<?php


namespace Digital\Requestinfo\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
		$installer = $setup;
		$installer->startSetup();

		/**
		 * Creating table digital_requestinfo
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable('digital_requestinfo')
		)->addColumn(
			'requestinfo_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Entity Id'
		)->addColumn(
			'sapcustomerid',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'SAP Customer ID'
		)->addColumn(
			'name',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Name'
		)->addColumn(
			'phone',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Phone'
		)->addColumn(
			'email',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Email'
		)->addColumn(
			'detailsofchangesrequired',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Details of changes required'
		)->addColumn(
			'date',
			\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
			null,
            [
              'nullable' => false, 
              'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
            ],
			'Date'
		)->addColumn(
			'exported',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
            ['nullable' => true,'default' => null],
			'Exported'
		)->addColumn(
			'count',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Count'
		)->addColumn(
			'response',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Response'
		)->addColumn(
			'created_at',
			\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
			null,
			['nullable' => false],
			'Created At'
		)->addColumn(
			'published_at',
			\Magento\Framework\DB\Ddl\Table::TYPE_DATE,
			null,
			['nullable' => true,'default' => null],
			'World publish date'
		)->addIndex(
			$installer->getIdxName(
				'digital_requestinfo',
				['published_at'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_INDEX
			),
			['published_at'],
			['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_INDEX]
		)->setComment(
			'Requestinfo item'
		);
		$installer->getConnection()->createTable($table);
		$installer->endSetup();
	}
}