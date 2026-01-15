<?php

declare(strict_types=1);

use Yiisoft\Db\Migration\MigrationBuilder;
use Yiisoft\Db\Migration\RevertibleMigrationInterface;

/**
 * Sample Migration in Yii3
 * 
 * Key differences from Yii2:
 * - Implements RevertibleMigrationInterface instead of extending Migration
 * - Uses MigrationBuilder for fluent table creation
 * - No safeUp/safeDown - just up() and down()
 * - Uses PHP 8+ syntax with readonly and strict types
 */
final class M20260115_CreateUserTable implements RevertibleMigrationInterface
{
    public function up(MigrationBuilder $b): void
    {
        $b->createTable('{{%user}}', [
            'id' => $b->primaryKey(),
            'username' => $b->string(255)->notNull()->unique(),
            'email' => $b->string(255)->notNull()->unique(),
            'password_hash' => $b->string(255)->notNull(),
            'auth_key' => $b->string(32)->notNull(),
            'status' => $b->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $b->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $b->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        // Create indexes
        $b->createIndex('idx-user-email', '{{%user}}', 'email');
        $b->createIndex('idx-user-status', '{{%user}}', 'status');
    }

    public function down(MigrationBuilder $b): void
    {
        $b->dropTable('{{%user}}');
    }
}
