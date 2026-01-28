# 🧩 Key Components

This document details the core components that drive the application's logic.

## 🔐 Authentication & Identity

The application strictly separates the **Authentication Identity** from the **Business Entity**.

### `App\User\Identity`
- **Location:** `src/User/Identity.php`
- **Purpose:** Implements `Yiisoft\Auth\IdentityInterface`. It is the object stored in the session representing the currently logged-in user.
- **Responsibilities:**
    - Providing the User ID (`getId()`).
    - Validating passwords (`validatePassword()`).
    - Exposing minimal data needed for the session (email, username).

### `App\Entity\User`
- **Location:** `src/Entity/User.php`
- **Purpose:** The full business object representing a user in the system.
- **Usage:** Used in business logic, repositories, and views where full user data is needed.

## 🎮 Web Actions

Yii3 moves away from "Fat Controllers" to **Single-Action Classes**.

### The Action Pattern
Instead of a `SiteController` with `actionIndex`, `actionLogin`, etc., we have dedicated classes:

- `App\Web\HomePage\Action` (Handles `/`)
- `App\Web\Auth\LoginAction` (Handles `/login`)

**Benefits:**
- **Dependency Injection:** Dependencies are injected into the Action's `__construct`, not a massive Controller constructor.
- **SRP:** Each class does exactly one thing.

**Typical Structure:**
```php
class Action
{
    public function __construct(private Service $service) {}

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        // Handle request
        return $this->responseFactory->createResponse(...);
    }
}
```

## ⚙️ Configuration System

The application uses `yiisoft/config` to assemble configuration at runtime.

- **Merge Plan:** Defined in `config/configuration.php`.
- **Params:** `config/common/params.php` contains simple values (DB host, debug flags).
- **DI Container:** `config/common/di/*.php` defines how classes are instantiated.

**Note:** Do not look for a single `web.php` config file. Configuration is composed of many small files.
