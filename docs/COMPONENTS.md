# 🧩 Key Components

This document outlines the key components of the application, their responsibilities, and relationships.

## 👤 User Domain & Authentication

The user domain is split into **Authentication** (Identity) and **Domain** (Entity).

### 1. Identity (`App\User\Identity`)
-   **Location:** `src/User/Identity.php`
-   **Type:** Value Object / Identity
-   **Implements:** `Yiisoft\Auth\IdentityInterface`
-   **Purpose:** Represents the *currently logged-in user*. Used by the `CurrentUser` service to maintain session state.
-   **Key Methods:** `getId()`, `validatePassword()`

### 2. IdentityRepository (`App\User\IdentityRepository`)
-   **Location:** `src/User/IdentityRepository.php`
-   **Type:** Repository
-   **Implements:** `Yiisoft\Auth\IdentityRepositoryInterface`
-   **Purpose:** Loads `Identity` objects from the database.
-   **Key Methods:**
    -   `findIdentity(string $id)`: For session restoration.
    -   `findIdentityByToken(string $token)`: For API auth.
    -   `findByEmail(string $email)`: For login form.
    -   `create(...)`: Creates a new user (Note: This currently handles write persistence for the User domain as well).

### 3. User Entity (`App\Entity\User`)
-   **Location:** `src/Entity/User.php`
-   **Type:** Domain Entity
-   **Purpose:** Represents a User in the business context. It is an **immutable** class.
-   **Key Features:**
    -   `readonly` properties.
    -   `withEmail()` style mutators that return a new instance.
    -   Decoupled from the database (no Active Record methods like `save()`).

---

## 🌐 Web Layer Features

The web layer is organized by feature.

### LoginAction (`App\Web\Auth\LoginAction`)
-   **Location:** `src/Web/Auth/LoginAction.php`
-   **Type:** Request Handler (Action)
-   **Purpose:** Handles the Login page (GET) and Login submission (POST).
-   **Dependencies:**
    -   `CurrentUser`: To check guest status and login the user.
    -   `IdentityRepository`: To find the user by email.
    -   `ViewRenderer`: To render the HTML template.
-   **Flow:**
    1.  Checks if user is already logged in (redirects to Dashboard if so).
    2.  If POST: Validates email/password -> Logs in via `CurrentUser` -> Redirects.
    3.  If GET: Renders `login.php` template.

### DashboardAction (`App\Web\Dashboard\DashboardAction`)
-   **Location:** `src/Web/Dashboard/DashboardAction.php`
-   **Type:** Request Handler
-   **Purpose:** Displays the user dashboard.
-   **Protection:** This route is protected by `Yiisoft\Auth\Middleware\Authentication`.
