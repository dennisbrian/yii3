# 📂 Directory Structure

This document provides a detailed map of the project's directory structure.

## Root Directory

| Path | Purpose |
|------|---------|
| `.Jules/` | Documentation journal and notes. |
| `assets/` | Compiled frontend assets (e.g., generated Tailwind CSS). |
| `config/` | Application configuration files (Merge Plan + Partials). |
| `docker/` | Docker infrastructure configuration. |
| `docs/` | Project documentation. |
| `migrations/` | Database migration classes. |
| `node_modules/` | Node.js dependencies. |
| `public/` | Web server root (contains `index.php`). |
| `runtime/` | Generated files at runtime (logs, cache, debug data). |
| `src/` | **Main Application Source Code.** |
| `tests/` | Codeception and PHPUnit tests. |
| `vendor/` | PHP Composer dependencies. |
| `Makefile` | Build automation commands. |
| `composer.json` | PHP dependency definition. |
| `package.json` | Node.js dependency definition (Tailwind). |
| `yii` | Console entry point script. |

## `src/` - Application Core

The source code is organized by **Feature** (Web) and **Domain** (User, Entity).

```
src/
├── Console/             # Console commands
├── Entity/              # Domain Entities (Immutable data objects)
│   └── User.php         # The Business Entity for a User
├── Repository/          # Data access logic (e.g., IdentityRepository)
├── Shared/              # Shared utilities
├── User/                # "User" Domain Module (Auth logic)
│   ├── Identity.php           # Auth Identity (IdentityInterface)
│   └── IdentityRepository.php # Persistence logic for Identity
├── Web/                 # Web Interface (Organized by Feature)
│   ├── Auth/                  # Login/Logout features
│   │   ├── LoginAction.php    # Handles /login
│   │   ├── LogoutAction.php   # Handles /logout
│   │   └── login.php          # Login View Template
│   ├── Dashboard/             # Dashboard feature
│   │   ├── DashboardAction.php
│   │   └── dashboard.php
│   ├── HomePage/              # Home page feature
│   │   ├── Action.php
│   │   └── home.php
│   ├── Shared/                # Shared Web Components
│   │   └── Layout/            # Main layout templates
│   └── NotFound/              # 404 Error handling
└── input.css            # Tailwind CSS source file
```

## `config/` - Configuration

Yii3 uses a plugin-based configuration system.

```
config/
├── common/              # Configs shared by Web and Console
│   ├── params.php       # Parameters (DB credentials, debug flags)
│   ├── routes.php       # URL Routing definitions
│   └── di/              # Dependency Injection definitions
├── console/             # Console-specific configs
├── web/                 # Web-specific configs
├── environments/        # Environment-specific overrides (dev, prod, test)
└── configuration.php    # The "Merge Plan" - defines the load order
```

## `docker/` - Infrastructure

```
docker/
├── dev/                 # Development environment overrides
├── prod/                # Production environment settings
├── test/                # Test environment settings
├── Dockerfile           # Main Docker image definition
└── compose.yml          # Base Docker Compose file
```

## `tests/` - Testing

```
tests/
├── Acceptance/          # Browser-based acceptance tests
├── Functional/          # Controller/API tests
├── Unit/                # Unit tests for classes
└── Support/             # Test support classes and helpers
```
