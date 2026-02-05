# 🏗️ Architecture Overview

This document describes the architectural decisions and patterns used in the Yii3 Web Application.

## 🌟 Core Philosophy: Yii3

This application is built on **Yii3**, which differs significantly from Yii2.
-   **Component-Based:** Yii3 is a suite of independent packages (e.g., `yiisoft/di`, `yiisoft/http`, `yiisoft/db`) rather than a monolithic framework.
-   **Strict Types:** The codebase leverages PHP 8 features and strict typing.
-   **DI Container:** Dependency Injection is central to the application. Almost everything is wired through the container.

## 📂 Application Structure

The application follows a modular, feature-based structure rather than a traditional flat MVC (Model-View-Controller) structure.

### 1. The Web Layer (`src/Web/`)
The Web layer is organized by **Features** or **Pages**.
-   **Purpose:** Handles HTTP requests and responses.
-   **Components:**
    -   **Actions:** Equivalent to Controller actions. Each Action is a standalone class (e.g., `App\Web\HomePage\Action`).
    -   **Templates:** View files are often co-located or organized similarly.
    -   **Forms:** Request validation models.

**Example Structure:**
```
src/Web/
├── Auth/           # Authentication Feature
│   ├── LoginAction.php
│   ├── LogoutAction.php
│   └── login.php   # Template
├── HomePage/       # Home Page Feature
│   ├── Action.php
│   └── home.php
```

### 2. The Domain Layer (`src/Entity`, `src/Repository`)
Business logic is separated from the HTTP layer.
-   **Purpose:** Encapsulates business rules and data persistence.
-   **Components:**
    -   **Entities:** Immutable data objects (e.g., `App\Entity\User`).
    -   **Repositories:** Data access abstraction (e.g., `App\Repository\UserRepository`).
    -   **Services:** Business operations.

### 3. Authentication Layer (`src/User/`)
Distinct from the core domain, this module handles Authentication Identity.
-   **Purpose:** Manages user sessions and identity verification.
-   **Components:**
    -   **Identity:** Lightweight object for auth state (e.g., `App\User\Identity`).
    -   **IdentityRepository:** Fetches identities for the `CurrentUser` service.
-   **Note:** See [Key Components](COMPONENTS.md) for a detailed explanation of the "Two Users" pattern.

```mermaid
classDiagram
    class Identity {
        +getId()
        +username
        +passwordHash
        <<Auth State>>
    }
    class User {
        +id
        +username
        +email
        +status
        +createdAt
        <<Domain Entity>>
    }
    class IdentityRepository {
        +findIdentity(id)
    }
    class UserRepository {
        +save(User)
        +findById(id)
    }

    Identity <.. IdentityRepository : Returns
    User <.. UserRepository : Returns

    note "src/User/ (Authentication)" for Identity
    note "src/Entity/ (Business Domain)" for User
```

### 4. Security & Access Control (RBAC)
The application uses **Role-Based Access Control (RBAC)** with a **Hybrid Storage** model.

-   **Roles & Permissions (Items):** Stored in **PHP files** (`rbac/items.php`).
    -   *Why:* Roles (like 'admin') and permissions are static parts of the application code/structure and rarely change at runtime.
    -   *Storage:* `Yiisoft\Rbac\Php\ItemsStorage`
-   **Assignments (Users -> Roles):** Stored in the **Database** (`yii_rbac_assignment` table).
    -   *Why:* User assignments are dynamic; admins need to grant/revoke roles at runtime.
    -   *Storage:* `Yiisoft\Rbac\Db\AssignmentsStorage`

```mermaid
graph LR
    subgraph File System
    Items[rbac/items.php]
    end

    subgraph Database
    AssignDB[(yii_rbac_assignment)]
    end

    subgraph Application
    Manager[RBAC Manager]
    end

    Items -->|Read Roles/Perms| Manager
    AssignDB <-->|Read/Write User Assignments| Manager
```

### 5. Configuration (`config/`)
Configuration is managed by `yiisoft/config`. Instead of a single config file, configurations are split and merged.

-   **`configuration.php`:** The "Merge Plan". Defines how files are combined.
-   **`common/`:** Configurations shared between Web and Console.
-   **`web/`:** Web-specific configs (routes, request handling).
-   **`console/`:** Console-specific configs (commands).
-   **`params.php`:** Simple key-value pairs (DB credentials, flags).

**How it works:**
The `composer.json` defines a `config-plugin-file`. When the app boots, the plugin merges the files defined in the plan into a single configuration array used to build the DI container.

```mermaid
graph TD
    subgraph Sources
    CP[common/params.php]
    WP[web/params.php]
    EP[environments/dev/params.php]
    CD[common/di/*.php]
    WD[web/di/*.php]
    CR[common/routes.php]
    end

    subgraph Merge Process
    CP --> PARAMS[Params Array]
    WP --> PARAMS
    EP --> PARAMS
    PARAMS --> DI

    CD --> DI[DI Container Definition]
    WD --> DI
    end

    CR --> ROUTER[Router Config]
    ROUTER --> DI
```

## 🔄 Request Lifecycle

```mermaid
sequenceDiagram
    participant Client
    participant Entry as public/index.php
    participant Container as DI Container
    participant Router
    participant Middleware
    participant Action

    Client->>Entry: HTTP Request
    Entry->>Container: Build (yiisoft/config)
    Entry->>Middleware: Run Application
    Middleware->>Router: Match Request
    Router-->>Middleware: Route Found
    Middleware->>Action: Invoke
    Action-->>Middleware: Response
    Middleware-->>Client: HTTP Response
```

1.  **Entry Point:** `public/index.php` (for Web) or `yii` (for Console).
2.  **Container Build:** `yiisoft/config` loads and merges configurations to build the DI Container.
3.  **Routing:** `yiisoft/router` matches the URL to a Route (defined in `config/common/routes.php`).
4.  **Middleware:** The request passes through a global middleware pipeline (e.g., ErrorHandler, Session, CSRF).
5.  **Action:** The matched Action class is instantiated and invoked.
6.  **Response:** The Action returns a `Response` object (often using a `ViewRenderer`).

```mermaid
graph TD
    A[Entry Point\n(public/index.php)] --> B[Build Container\n(yiisoft/config)]
    B --> C[Router\n(yiisoft/router)]
    C --> D[Middleware Pipeline\n(ErrorHandler, Session, CSRF)]
    D --> E[Action\n(e.g., LoginAction)]
    E --> F[Response]
```

## 🎨 Frontend Architecture

-   **Tailwind CSS:** Styling is handled by Tailwind.
-   **Source:** `src/input.css` contains the source CSS and Tailwind directives.
-   **Build:** The CSS is compiled to `assets/main/tailwind.css`.
-   **Integration:** The layout files include the compiled CSS asset.

## 💾 Database Access

The application uses a **Repository Pattern** for data persistence.

-   **Library:** `yiisoft/db` (Database Abstraction Layer) is used for Query Building.
-   **No ActiveRecord:** We do **not** use the ActiveRecord pattern. Database tables are not mapped 1:1 to logic classes.
-   **Repository Pattern:** All database queries are encapsulated in Repositories (e.g., `App\Repository\UserRepository`).
    -   Repositories accept `Yiisoft\Db\Connection\ConnectionInterface`.
    -   They use `Yiisoft\Db\Query\Query` to fetch data (arrays).
    -   They manually **hydrate** arrays into immutable Domain Entities (e.g., `App\Entity\User`).
-   **Migrations:** Database schema changes are managed via `yiisoft/db-migration` in the `migrations/` directory.
