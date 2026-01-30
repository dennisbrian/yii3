# 🗄️ Database Schema

This document details the database schema for the application.

## Overview

-   **Database Engine:** MySQL / MariaDB (via `yiisoft/db-mysql`)
-   **Migration Tool:** `yiisoft/db-migration`
-   **Migration Path:** `migrations/`

## Tables

### `user`

Stores user account information and authentication credentials.

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| `id` | `INT` (PK) | No | Auto Inc | Unique user identifier. |
| `username` | `VARCHAR(255)` | No | - | Unique username. |
| `email` | `VARCHAR(255)` | No | - | Unique email address. |
| `password_hash` | `VARCHAR(255)` | No | - | Bcrypt/Argon2 password hash. |
| `auth_key` | `VARCHAR(32)` | No | - | Random key for "remember me" functionality. |
| `status` | `SMALLINT` | No | `10` | User status (0=Deleted, 9=Inactive, 10=Active). |
| `created_at` | `TIMESTAMP` | No | `NOW()` | Record creation time. |
| `updated_at` | `TIMESTAMP` | No | `NOW()` | Last update time (auto-updates). |

**Indexes:**
-   `idx-user-email` (Unique) on `email`
-   `idx-user-status` on `status`
-   `username` is also defined as unique in the schema definition.

**Relationships:**
-   None currently.

**Notes:**
-   The `status` column logic is defined in `App\Entity\User` constants (`STATUS_DELETED`, `STATUS_INACTIVE`, `STATUS_ACTIVE`).
