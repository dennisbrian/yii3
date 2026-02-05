<?php

declare(strict_types=1);

use Yiisoft\Db\Migration\MigrationBuilder;
use Yiisoft\Db\Migration\RevertibleMigrationInterface;
use Yiisoft\Db\Migration\TransactionalMigrationInterface;

final class M20260116_CreateRbacTables implements RevertibleMigrationInterface, TransactionalMigrationInterface
{
    private const TABLE_PREFIX = 'yii_rbac_';
    private const ITEMS_TABLE = self::TABLE_PREFIX . 'item';
    private const ITEMS_CHILDREN_TABLE = self::TABLE_PREFIX . 'item_child';
    private const ASSIGNMENTS_TABLE = self::TABLE_PREFIX . 'assignment';

    public function up(MigrationBuilder $b): void
    {
        $this->createItemsTable($b);
        $this->createItemsChildrenTable($b);
        $this->createAssignmentsTable($b);
    }

    public function down(MigrationBuilder $b): void
    {
        $b->dropTable(self::ASSIGNMENTS_TABLE);
        $b->dropTable(self::ITEMS_CHILDREN_TABLE);
        $b->dropTable(self::ITEMS_TABLE);
    }

    private function createItemsTable(MigrationBuilder $b): void
    {
        $b->createTable(
            self::ITEMS_TABLE,
            [
                'name' => 'string(126) NOT NULL PRIMARY KEY',
                'type' => 'string(10) NOT NULL',
                'description' => 'string(191)',
                'rule_name' => 'string(64)',
                'created_at' => 'integer NOT NULL',
                'updated_at' => 'integer NOT NULL',
            ],
        );
        // Arguments: name, table, columns
        $b->createIndex('idx-' . self::ITEMS_TABLE . '-type', self::ITEMS_TABLE, 'type');
    }

    private function createItemsChildrenTable(MigrationBuilder $b): void
    {
        $b->createTable(
            self::ITEMS_CHILDREN_TABLE,
            [
                'parent' => 'string(126) NOT NULL',
                'child' => 'string(126) NOT NULL',
                'PRIMARY KEY ([[parent]], [[child]])',
                'FOREIGN KEY ([[parent]]) REFERENCES {{%' . self::ITEMS_TABLE . '}} ([[name]])',
                'FOREIGN KEY ([[child]]) REFERENCES {{%' . self::ITEMS_TABLE . '}} ([[name]])',
            ],
        );
    }

    private function createAssignmentsTable(MigrationBuilder $b): void
    {
        $b->createTable(
            self::ASSIGNMENTS_TABLE,
            [
                'item_name' => 'string(126) NOT NULL',
                'user_id' => 'string(126) NOT NULL',
                'created_at' => 'integer NOT NULL',
                'PRIMARY KEY ([[item_name]], [[user_id]])',
                // Keeping consistent with package migration - no FK for assignments by default?
                // But it's safer to have it if we know item must exist.
                // However, avoiding modification of "standard" schema to ensure compatibility.
            ],
        );
    }
}
