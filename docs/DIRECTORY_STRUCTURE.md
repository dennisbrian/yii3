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

The source code is organized by **Layer** (Entity, Repository) and **Feature** (Web).

```
src/
├── Console/             # Console commands (CLI)
├── Entity/              # Domain Entities (Immutable data objects)
│   └── User.php         # User entity definition
├── Repository/          # Data Access Layer
│   └── ...              # (Repositories would go here or in domain modules)
├── Shared/              # Shared utilities and components
├── User/                # "User" Domain Services & Logic
│   ├── Identity.php           # User identity implementation
│   └── IdentityRepository.php # User persistence logic
├── Web/                 # Web Interface (Feature-based Actions & Views)
│   ├── Auth/                  # Login/Logout features
│   │   ├── LoginAction.php
│   │   ├── LogoutAction.php
│   │   └── login.php (Template)
│   ├── Dashboard/             # User Dashboard
│   ├── HomePage/              # Landing Page
│   ├── Shared/                # Shared Web Components (Layouts, etc.)
│   └── NotFound/              # 404 Error Handling
└── input.css            # Tailwind CSS source file
```

> **Note on Structure:**
> - **Domain Logic:** Split between `Entity/` (data structures) and `User/` (business logic/services).
> - **Web Logic:** Grouped by "Feature" (e.g., `Auth`) rather than by technical type (Controller/View).

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
├── Web/                 # End-to-End / Acceptance tests (Browser emulation)
├── Functional/          # API / Integration tests
├── Unit/                # Unit tests for classes
├── Console/             # Console command tests
└── Support/             # Test support classes and helpers
```
