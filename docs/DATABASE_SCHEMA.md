# 🗄️ Database Schema

This document details the database schema for the application. The schema is managed via Yii3 migrations located in `migrations/`.

## 📐 Entity Relationship Diagram

```mermaid
erDiagram
    USER {
        int id PK
        string username
        string email
        string password_hash
        string auth_key
        smallint status
        timestamp created_at
        timestamp updated_at
    }
```

## 📋 Tables

### `user`

Stores user accounts for authentication and profile management.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | `INT` | `PK`, `AUTO_INCREMENT` | Unique identifier. |
| `username` | `VARCHAR(255)` | `NOT NULL`, `UNIQUE` | Unique username. |
| `email` | `VARCHAR(255)` | `NOT NULL`, `UNIQUE` | Unique email address. |
| `password_hash` | `VARCHAR(255)` | `NOT NULL` | Hashed password (Argon2i/Bcrypt). |
| `auth_key` | `VARCHAR(32)` | `NOT NULL` | Random key for "Remember Me" functionality. |
| `status` | `SMALLINT` | `NOT NULL`, `DEFAULT 10` | Account status (e.g., 10 = Active). |
| `created_at` | `TIMESTAMP` | `NOT NULL`, `DEFAULT NOW()` | Record creation time. |
| `updated_at` | `TIMESTAMP` | `NOT NULL`, `DEFAULT NOW()` | Record update time (auto-updates). |

**Indexes:**
*   `idx-user-email` on `email`
*   `idx-user-status` on `status`
