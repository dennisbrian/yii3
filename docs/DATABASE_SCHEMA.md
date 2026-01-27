# 🗄️ Database Schema

This document outlines the database schema for the application. The schema is managed via migrations located in `migrations/`.

## Tables

### `user`

Stores user account information.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| `id` | `INT` | `PK`, `AUTO_INCREMENT` | Unique identifier. |
| `username` | `VARCHAR(255)` | `NOT NULL`, `UNIQUE` | User's login name. |
| `email` | `VARCHAR(255)` | `NOT NULL`, `UNIQUE` | User's email address. |
| `password_hash` | `VARCHAR(255)` | `NOT NULL` | Hashed password (Argon2id/Bcrypt). |
| `auth_key` | `VARCHAR(32)` | `NOT NULL` | "Remember Me" authentication key. |
| `status` | `SMALLINT` | `NOT NULL`, `DEFAULT 10` | Account status (10 = Active). |
| `created_at` | `TIMESTAMP` | `NOT NULL`, `DEFAULT CURRENT_TIMESTAMP` | Record creation time. |
| `updated_at` | `TIMESTAMP` | `NOT NULL`, `DEFAULT CURRENT_TIMESTAMP` | Last update time. |

**Indexes:**
- `idx-user-email` on `email`
- `idx-user-status` on `status`

**Source Migration:** `migrations/M20260115_CreateUserTable.php`
