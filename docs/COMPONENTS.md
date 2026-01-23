# 🧩 Key Components

This document details key components and modules within the application, focusing on their responsibilities and interactions.

## User Domain (`src/User/`, `src/Entity/`)

The User domain is split into two distinct parts: the **Domain Model** (Entity) and the **Identity** (Authentication).

### 1. User Entity (`App\Entity\User`)
**Location:** `src/Entity/User.php`

**Purpose:**
Represents the business object for a User. This is a pure data object (DTO-like) used for business logic and persistence.

**Key Characteristics:**
-   **Immutable:** Uses PHP 8 `readonly` properties.
-   **Decoupled:** Does not extend `ActiveRecord` or any framework class.
-   **Methods:** Contains domain logic like `isActive()` and immutable setters (e.g., `withEmail()`).

### 2. User Identity (`App\User\Identity`)
**Location:** `src/User/Identity.php`

**Purpose:**
Represents the currently authenticated user session. It adapts the User data to the `Yiisoft\Auth\IdentityInterface` required by the framework's authentication system.

**Key Characteristics:**
-   **Implements:** `Yiisoft\Auth\IdentityInterface`.
-   **Responsibilities:** Provides ID to the session, validates passwords (`validatePassword()`).
-   **Separation:** It is *not* the same as the Entity, although it may share similar data fields. This allows the Auth logic to change independently of the Domain logic.

### 3. Identity Repository (`App\User\IdentityRepository`)
**Location:** `src/User/IdentityRepository.php`

**Purpose:**
Handles the retrieval of Identity objects, typically from the database. It bridges the gap between the storage (DB) and the Auth system.

## Web Features (`src/Web/`)

The web layer is organized by feature.

### Auth Feature (`src/Web/Auth/`)
Handles login and logout operations.
-   **`LoginAction`**: Processes login forms, validates credentials using `IdentityRepository`, and logs the user in.
-   **`LogoutAction`**: Clears the user session.

### Dashboard Feature (`src/Web/Dashboard/`)
Example of a protected area.
-   **`DashboardAction`**: Renders the dashboard view.
-   **Protection:** Protected by `Authentication` middleware in the route definition.
