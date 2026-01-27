# 🧩 Key Components

This document details the key architectural components of the application, focusing on the separation between Web Features and Domain Logic.

## 🌐 Web Layer (`src/Web/`)

The Web layer is organized by **Feature**, not by technical layer (Controller/View).

### Auth Feature
*   **Location:** `src/Web/Auth/`
*   **Purpose:** Handles user authentication (Login/Logout).
*   **Key Files:**
    *   `LoginAction.php`: Handles the login form submission and authentication logic.
    *   `LogoutAction.php`: Logs the user out.
    *   `login.php`: The login page template.

### Dashboard Feature
*   **Location:** `src/Web/Dashboard/`
*   **Purpose:** Protected area for authenticated users.
*   **Key Files:**
    *   `DashboardAction.php`: Renders the dashboard.
    *   `dashboard.php`: Dashboard template.
*   **Middleware:** Protected by `Authentication::class` middleware (configured in `routes.php`).

### HomePage Feature
*   **Location:** `src/Web/HomePage/`
*   **Purpose:** Public landing page.
*   **Key Files:**
    *   `Action.php`: Renders the home page.
    *   `template.php`: Home page template.

---

## 🧠 Domain Layer

The Domain layer encapsulates business logic and data access, strictly separated from the Web layer.

### User Domain

The User domain is split into two distinct concepts:

#### 1. Business Entity (`App\Entity\User`)
*   **Location:** `src/Entity/User.php`
*   **Purpose:** Represents the immutable business object for a User.
*   **Characteristics:**
    *   **Immutable:** Uses PHP 8 `readonly` properties.
    *   **Pure:** No database dependencies (ActiveRecord is NOT used).
    *   **Logic:** Contains domain methods like `isActive()`.

#### 2. Auth Identity (`App\User\Identity`)
*   **Location:** `src/User/Identity.php`
*   **Purpose:** Adapts the user data for the `yiisoft/auth` package.
*   **Interface:** Implements `Yiisoft\Auth\IdentityInterface`.
*   **Responsibility:** Provides methods like `getId()` and `validatePassword()` strictly for the authentication mechanism.

---

## 💾 Data Access (Repositories)

Repositories abstract the database interactions, returning Domain Entities or Identity objects.

### UserRepository
*   **Location:** `src/Repository/UserRepository.php`
*   **Purpose:** Fetches `App\Entity\User` objects from the database.
*   **Usage:** Used by business services to retrieve user data.

### IdentityRepository
*   **Location:** `src/User/IdentityRepository.php`
*   **Purpose:** Fetches `App\User\Identity` objects for the Authentication middleware.
*   **Interface:** Likely implements `Yiisoft\Auth\IdentityRepositoryInterface`.

---

## 🤝 Relationship Diagram

```mermaid
graph TD
    subgraph Web Layer
        LoginAction[LoginAction]
    end

    subgraph Domain Layer
        IdentityRepo[IdentityRepository]
        UserRepo[UserRepository]
        Identity[Identity (Auth)]
        UserEntity[User (Business)]
    end

    subgraph Database
        DB[(MySQL)]
    end

    LoginAction --> IdentityRepo
    IdentityRepo --> DB
    IdentityRepo --> Identity

    UserRepo --> DB
    UserRepo --> UserEntity
```
