# 🗄️ Database Schema

This document outlines the database schema for the application.

## Tables

### `user`

Stores user account information.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| `id` | `int` | `PK`, `AI` | Unique identifier |
| `username` | `varchar(255)` | `NOT NULL`, `UNIQUE` | User's login name |
| `email` | `varchar(255)` | `NOT NULL`, `UNIQUE` | User's email address |
| `password_hash` | `varchar(255)` | `NOT NULL` | Hashed password |
| `auth_key` | `varchar(32)` | `NOT NULL` | "Remember Me" authentication key |
| `status` | `smallint` | `NOT NULL`, Default `10` | Account status (10=Active) |
| `created_at` | `timestamp` | `NOT NULL`, Default `NOW()` | Creation timestamp |
| `updated_at` | `timestamp` | `NOT NULL`, Default `NOW()` | Last update timestamp |

**Indexes:**
- `idx-user-email`: On `email` column.
- `idx-user-status`: On `status` column.

## Migration System

The project uses `yiisoft/db-migration`.

### Revertible Migrations
Migrations implement `Yiisoft\Db\Migration\RevertibleMigrationInterface`. This requires `up()` and `down()` methods.

**Example:**
```php
public function up(MigrationBuilder $b): void
{
    $b->createTable('{{%user}}', [
        'id' => $b->primaryKey(),
        // ...
    ]);
}

public function down(MigrationBuilder $b): void
{
    $b->dropTable('{{%user}}');
}
```

### Running Migrations
Run migrations via the Makefile:
```bash
make yii migrate
```
