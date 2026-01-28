# 🗄️ Database Schema

The application uses **MySQL** as the primary data store, accessed via `yiisoft/db`.

## Tables

### `user`
Stores user account information.

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| `id` | `INT` | `PK`, `AUTO_INCREMENT` | Unique identifier. |
| `username` | `VARCHAR(255)` | `NOT NULL`, `UNIQUE` | Unique username. |
| `email` | `VARCHAR(255)` | `NOT NULL`, `UNIQUE` | User email address. |
| `password_hash` | `VARCHAR(255)` | `NOT NULL` | Hashed password (BCrypt/Argon2). |
| `auth_key` | `VARCHAR(32)` | `NOT NULL` | Random key for "remember me" or API auth. |
| `status` | `SMALLINT` | `NOT NULL`, `DEFAULT 10` | Account status (10 = Active). |
| `created_at` | `TIMESTAMP` | `NOT NULL`, `DEFAULT NOW()` | Creation timestamp. |
| `updated_at` | `TIMESTAMP` | `NOT NULL` | Last update timestamp. |

**Indexes:**
- `idx-user-email` on `email`
- `idx-user-status` on `status`

## Domain Entities

The database tables map to Domain Entities in `src/Entity/`.

### `App\Entity\User`
Represents a row in the `user` table.

- **Type:** Immutable PHP Class (Not ActiveRecord)
- **Location:** `src/Entity/User.php`
- **Mapping:**
    - The entity does *not* contain database logic (queries/saves).
    - Database operations are handled by `Repository` classes (e.g., `App\User\IdentityRepository`).
    - The entity uses `readonly` properties for immutability.

```php
// Example Instantiation
$user = new User(
    username: 'jdoe',
    email: 'jdoe@example.com'
);
```
