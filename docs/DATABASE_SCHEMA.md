# 🗄️ Database Schema

This document details the database schema and entity relationships for the application.

## 📋 Overview

The application uses a relational database (MySQL by default). The schema is managed via migrations located in `migrations/`.

## 📦 Tables

### `user`

The `user` table stores authentication identity and profile information.

| Column | Type | Nullable | Default | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | `INT` (PK) | No | Auto Inc | Unique identifier |
| `username` | `VARCHAR(255)` | No | - | Unique username |
| `email` | `VARCHAR(255)` | No | - | Unique email address |
| `password_hash` | `VARCHAR(255)` | No | - | Hashed password (Argon2id/Bcrypt) |
| `auth_key` | `VARCHAR(32)` | No | - | "Remember Me" authentication key |
| `status` | `SMALLINT` | No | `10` | User status (10=Active, 9=Inactive, 0=Deleted) |
| `created_at` | `TIMESTAMP` | No | `CURRENT_TIMESTAMP` | Record creation time |
| `updated_at` | `TIMESTAMP` | No | `CURRENT_TIMESTAMP` | Record update time |

**Indexes:**
*   `idx-user-email` (on `email`)
*   `idx-user-status` (on `status`)

## 📐 Entity Relationship Diagram (ERD)

```mermaid
erDiagram
    USER {
        int id PK
        string username
        string email
        string password_hash
        string auth_key
        int status
        timestamp created_at
        timestamp updated_at
    }
```

## 📝 Notes

*   **Status Codes:**
    *   `10`: Active
    *   `9`: Inactive
    *   `0`: Deleted
