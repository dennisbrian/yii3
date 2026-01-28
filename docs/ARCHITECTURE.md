# 🏗️ Architecture Overview

This document describes the architectural decisions and patterns used in the Yii3 Web Application.

## 🌟 Core Philosophy: Yii3

This application is built on **Yii3**, which differs significantly from Yii2.
-   **Component-Based:** Yii3 is a suite of independent packages (e.g., `yiisoft/di`, `yiisoft/http`, `yiisoft/db`) rather than a monolithic framework.
-   **Strict Types:** The codebase leverages PHP 8 features and strict typing.
-   **DI Container:** Dependency Injection is central to the application. Almost everything is wired through the container.

## 📂 Application Structure

The application follows a modular, feature-based structure, strictly separating the **HTTP Layer** from the **Domain Layer**.

### 1. The Web Layer (`src/Web/`)
The Web layer is organized by **Features** or **Pages**. It handles the "Delivery Mechanism" (HTTP).
-   **Purpose:** Handles HTTP requests, input validation, and rendering responses.
-   **Components:**
    -   **Actions:** Single-action classes (e.g., `App\Web\HomePage\Action`) replace traditional "Controllers".
    -   **Templates:** View files are co-located with the feature.

**Example Structure:**
```
src/Web/Auth/           # The Authentication Feature
├── LoginAction.php     # Handles POST /login
└── login.php           # The HTML template
```

### 2. The Domain Layer (`src/User/`, `src/Entity/`)
Business logic is separated from the HTTP layer.

-   **Entities (`src/Entity/`):** Immutable, plain PHP objects representing business data (e.g., `User`). These are **NOT** ActiveRecord models.
-   **Identity (`src/User/Identity.php`):** Specifically for Authentication (implements `IdentityInterface`).
-   **Repositories (`src/Repository/`):** Handle data persistence (SQL queries).

#### ⚠️ Entity vs. Identity
-   **Entity (`App\Entity\User`):** The full business object with all user data.
-   **Identity (`App\User\Identity`):** A lightweight object used only for the current session state.

### 3. Configuration (`config/`)
Configuration is managed by `yiisoft/config`. Instead of a single config file, configurations are split and merged.

-   **`configuration.php`:** The "Merge Plan". Defines how files are combined.
-   **`common/`:** Configurations shared between Web and Console.
-   **`web/`:** Web-specific configs (routes, request handling).
-   **`params.php`:** Simple key-value pairs (DB credentials, flags).

**How it works:**
The `composer.json` defines a `config-plugin-file`. When the app boots, the plugin merges the files defined in the plan into a single configuration array used to build the DI container.

## 🔄 Request Lifecycle

```mermaid
graph TD
    A[Entry Point (index.php)] --> B[Config Plugin]
    B --> C{DI Container}
    C --> D[Router]
    D --> E[Middleware Pipeline]
    E --> F[Error Handler]
    F --> G[Session/Auth]
    G --> H[Action (e.g. LoginAction)]
    H --> I[Response]
    I --> J[Emitter (Send to Browser)]
```

1.  **Entry Point:** `public/index.php`.
2.  **Container Build:** `yiisoft/config` loads and merges configurations to build the DI Container.
3.  **Routing:** `yiisoft/router` matches the URL to a Route (defined in `config/common/routes.php`).
4.  **Middleware:** The request passes through a global middleware pipeline (Error Handling, Session, CSRF, Auth).
5.  **Action:** The matched Action class is instantiated and invoked.
6.  **Response:** The Action returns a `Response` object (often using a `ViewRenderer`).

## 🎨 Frontend Architecture

-   **Tailwind CSS:** Styling is handled by Tailwind.
-   **Source:** `src/input.css` contains the source CSS and Tailwind directives.
-   **Build:** The CSS is compiled to `assets/main/tailwind.css`.
-   **Integration:** The layout files include the compiled CSS asset.

## 💾 Database Access

-   **Library:** `yiisoft/db` (Database Abstraction Layer).
-   **Migrations:** Managed via `yiisoft/db-migration` in `migrations/`.
-   **Schema:** See [DATABASE_SCHEMA.md](DATABASE_SCHEMA.md) for details.
