# 🗄️ Database Schema

## Overview
The database schema is managed via **Yii3 Migrations** located in `migrations/`.

## Tables

### `user`
Stores user account information.

| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| `id` | `PK` | Primary Key | Unique identifier |
| `username` | `VARCHAR(255)` | `NOT NULL`, `UNIQUE` | User's login name |
| `email` | `VARCHAR(255)` | `NOT NULL`, `UNIQUE` | Contact email |
| `password_hash` | `VARCHAR(255)` | `NOT NULL` | Hashed password |
| `auth_key` | `VARCHAR(32)` | `NOT NULL` | Cookie auth key |
| `status` | `SMALLINT` | `NOT NULL`, Default `10` | Account status (10=Active) |
| `created_at` | `TIMESTAMP` | `NOT NULL` | Creation time |
| `updated_at` | `TIMESTAMP` | `NOT NULL` | Update time |

**Indexes:**
- `idx-user-email` on `email`
- `idx-user-status` on `status`

## Relationships
*No explicit foreign key relationships defined yet.*
