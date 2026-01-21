# 🧩 Components Reference

This document details key application components, their responsibilities, and how they interact.

## 👤 User Domain

### `App\Entity\User`
**Location:** `src/Entity/User.php`

**Purpose:**
Represents a user identity in the system.

**Responsibilities:**
-   Holds user state (ID, username, email, etc.).
-   Provides immutable methods for state modification (e.g., `withEmail()`).
-   Contains status constants (`STATUS_ACTIVE`, `STATUS_DELETED`, etc.).
-   **DOES NOT** interact with the database directly.

**Key Design Pattern:** Immutable Object.

### `App\User\IdentityRepository`
**Location:** `src/User/IdentityRepository.php`

**Purpose:**
Handles persistence and retrieval of `User` entities.

**Responsibilities:**
-   Fetching users by ID, email, or token.
-   Saving new user records to the database.
-   Mapping database rows to `User` entity objects.

## 🔐 Authentication Feature

### `App\Web\Auth\LoginAction`
**Location:** `src/Web/Auth/LoginAction.php`

**Purpose:**
Handles the user login process.

**Responsibilities:**
-   Displays the login form (GET).
-   Validates user input (POST).
-   Authenticates the user using the `IdentityRepository` or `AuthService`.
-   Redirects to the dashboard upon success.

### `Yiisoft\Auth\Middleware\Authentication`
**Location:** Vendor package (configured in routes).

**Purpose:**
Protects routes that require a logged-in user.

**Responsibilities:**
-   Checks for a valid identity in the request.
-   Returns `401 Unauthorized` if no identity is found (or redirects to login).

## 🖥️ Web Components

### `App\Web\HomePage\Action`
**Location:** `src/Web/HomePage/Action.php`

**Purpose:**
Renders the landing page.

**Responsibilities:**
-   Prepare data for the home page.
-   Render the `home` template.

### `App\Web\Dashboard\DashboardAction`
**Location:** `src/Web/Dashboard/DashboardAction.php`

**Purpose:**
Renders the user dashboard.

**Responsibilities:**
-   Fetch user-specific statistics or data.
-   Render the `dashboard` template.
