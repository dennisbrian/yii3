# 📂 Directory Structure

This document provides a detailed map of the project's directory structure.

## Root Directory

| Path | Purpose |
|------|---------|
| `.Jules/` | Documentation journal and notes. |
| `assets/` | Compiled frontend assets (e.g., generated Tailwind CSS). |
| `config/` | Application configuration files. |
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

The source code is organized by **Feature** (Web) and **Domain** (Entity, User, Shared).

```
src/
├── Console/             # Console commands
├── Entity/              # Domain Entities (Business Logic)
│   └── User.php               # Full User Domain Model
├── Repository/          # Domain Repositories (Data Access)
│   └── UserRepository.php     # User Data Management
├── Shared/              # Shared utilities and components
├── User/                # Authentication Identity Module
│   ├── Identity.php           # Lightweight Auth Identity
│   └── IdentityRepository.php # Auth-specific persistence
├── Web/                 # Web Interface (Feature-based)
│   ├── Auth/                  # Authentication feature
│   ├── Dashboard/             # Dashboard feature
│   ├── HomePage/              # Home page feature
│   ├── Shared/                # Shared web components
│   └── NotFound/              # 404 handling
├── Environment.php      # Environment variable helper
├── autoload.php         # Application bootstrapper
└── input.css            # Tailwind CSS source file
```

## `config/` - Configuration

Yii3 uses a plugin-based configuration system.

```
config/
├── common/              # Configs shared by Web and Console
│   ├── params.php       # Parameters (DB settings, etc.)
│   └── routes.php       # URL Routing definitions
├── console/             # Console-specific configs
├── web/                 # Web-specific configs
├── environments/        # Environment-specific overrides (dev, prod, test)
└── configuration.php    # The "Merge Plan" - defines how configs are loaded
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
