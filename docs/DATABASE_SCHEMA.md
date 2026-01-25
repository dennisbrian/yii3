# 🗄️ Database Schema

This document describes the database schema used by the application. The schema is managed via database migrations located in the `migrations/` directory.

## Management

-   **Migration Tool:** `yiisoft/db-migration`
-   **Run Migrations:** `make yii migrate`
-   **Create Migration:** `make yii migrate/create [name]`

## Tables

### `user`

Stores user account information for authentication and profile management.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| `id` | `INT` | `PK`, `AI` | Unique user identifier. |
| `username` | `VARCHAR(255)` | `NOT NULL`, `UNIQUE` | Unique username for display or login. |
| `email` | `VARCHAR(255)` | `NOT NULL`, `UNIQUE` | User's email address (primary login). |
| `password_hash` | `VARCHAR(255)` | `NOT NULL` | Bcrypt/Argon2 password hash. |
| `auth_key` | `VARCHAR(32)` | `NOT NULL` | Random key for "Remember Me" or API auth. |
| `status` | `SMALLINT` | `NOT NULL`, Default `10` | User status (e.g., 10 = Active). |
| `created_at` | `TIMESTAMP` | `NOT NULL` | Record creation timestamp. |
| `updated_at` | `TIMESTAMP` | `NOT NULL` | Last update timestamp. |

**Indexes:**
-   `idx-user-email`: On `email` (Unique lookup)
-   `idx-user-status`: On `status` (Filtering)
