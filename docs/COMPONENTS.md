# 🧩 Key Components

This document details the key components of the application, focusing on Domain Logic and Web Actions.

## User Domain (`src/User/`)

The User domain handles identity management and authentication.

### `App\User\Identity`
**Type:** Entity (Immutable)
**Purpose:** Represents an authenticated user's identity.
**Implements:** `Yiisoft\Auth\IdentityInterface`
**Responsibilities:**
-   Holds user data (ID, email, hash).
-   Validates passwords (`validatePassword()`).
-   Provides accessors for identity attributes.

### `App\User\IdentityRepository`
**Type:** Repository
**Purpose:** Abstracts database access for User Identities.
**Implements:** `Yiisoft\Auth\IdentityRepositoryInterface`
**Responsibilities:**
-   `findIdentity($id)`: Retrieves user by ID (Session Auth).
-   `findIdentityByToken($token)`: Retrieves user by API Token.
-   `findByEmail($email)`: Retrieves user for Login.
-   `create(...)`: Handles new user creation and password hashing.

## Web Actions (`src/Web/`)

The application uses the **Single Action Controller** pattern where each HTTP endpoint maps to a specific Action class with an `__invoke` method.

### `App\Web\Auth\LoginAction`
**Location:** `src/Web/Auth/LoginAction.php`
**Route:** `GET|POST /login`
**Purpose:** Handles user login flow.
**Dependencies:** `CurrentUser`, `IdentityRepository`, `ViewRenderer`.
**Flow:**
1.  Checks if user is already logged in (redirects to Dashboard).
2.  **GET:** Renders `login` view.
3.  **POST:**
    -   Validates email/password from body.
    -   Uses `IdentityRepository` to find user.
    -   Calls `CurrentUser->login($identity)`.
    -   Redirects on success or shows error on failure.

### `App\Web\Dashboard\DashboardAction`
**Location:** `src/Web/Dashboard/DashboardAction.php`
**Route:** `GET /dashboard`
**Purpose:** Displays the protected user dashboard.
**Middleware:** Protected by `Yiisoft\Auth\Middleware\Authentication`.
**Flow:**
1.  Retrieves current identity via `CurrentUser->getIdentity()`.
2.  Renders `dashboard` view passing the identity.

## Testing Components (`tests/`)

-   **Unit Tests:** Located in `tests/Unit`. Test individual classes (Entities, Services) in isolation.
-   **Functional Tests:** Located in `tests/Functional`. Test Actions and API endpoints simulating HTTP requests.
