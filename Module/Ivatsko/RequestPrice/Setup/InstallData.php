<?php
declare(strict_types=1);

namespace Ivatsko\RequestPrice\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 * @package Ivatsko\RequestPrice\Setup
 */
class InstallData implements InstallDataInterface
{

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $dataNames = ['New', 'In Progress', 'Closed'];
        $tableName = 'request_price_status';
        foreach ($dataNames as $dataName) {
            $setup->getConnection()->query('INSERT INTO ' . $tableName . " (name) VALUES " . "('$dataName')");
        }

        $setup->endSetup();
    }
}
