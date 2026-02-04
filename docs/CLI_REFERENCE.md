# 💻 CLI Reference

This document lists the available console commands in the application.

## 🚀 Usage

You can run console commands using the `yii` script in the root directory.

```bash
# If running locally
./yii [command] [arguments]

# If running via Docker (recommended)
make yii [command] [arguments]
```

## 🛠️ Available Commands

### `user:create-admin`

Creates a new user and assigns them the 'admin' role.

**Usage:**
```bash
./yii user:create-admin <email> <password> [username]
```

**Arguments:**
- `email` (Required): The email address of the new admin.
- `password` (Required): The password for the new admin.
- `username` (Optional): The username. If omitted, it defaults to the email prefix (before the `@`).

**Example:**
```bash
./yii user:create-admin admin@example.com mySecurePassword123
```

**What it does:**
1.  Checks if a user with the given email already exists.
2.  Creates a new `User` entity and persists it via `IdentityRepository`.
3.  Updates `rbac/assignments.php` to assign the `admin` role to the new user ID.

---

### `hello`

An example command to verify the console application is working.

**Usage:**
```bash
./yii hello
```

**Output:**
```
Hello!
```
