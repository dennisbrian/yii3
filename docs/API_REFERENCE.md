# 📡 API & Route Reference

This document lists the application's defined routes and endpoints.

## Route Definitions
Routes are defined in `config/common/routes.php` using `Yiisoft\Router\Group`.

## Available Routes

| Method | Path | Action Class | Name | Middleware |
|--------|------|--------------|------|------------|
| `GET` | `/` | `App\Web\HomePage\Action` | `home` | - |
| `GET`, `POST` | `/login` | `App\Web\Auth\LoginAction` | `login` | - |
| `GET` | `/logout` | `App\Web\Auth\LogoutAction` | `logout` | - |
| `GET` | `/dashboard` | `App\Web\Dashboard\DashboardAction` | `dashboard` | `Authentication` |

## Middleware

### Global Middleware
Global middleware is configured in the middleware dispatcher (often in `config/web/application.php` or `params.php`). Common global middleware includes:
- `ErrorCatcher`
- `SessionMiddleware`
- `CsrfMiddleware`

### Route Middleware
- **`Authentication`**: Ensures the user is logged in. Used for protected routes like `/dashboard`.

## Adding Routes

To add a new route:
1.  Create the Action class in `src/Web/{Feature}/Action.php`.
2.  Add the route definition in `config/common/routes.php`:
    ```php
    Route::get('/new-feature')
        ->action(App\Web\NewFeature\Action::class)
        ->name('new-feature');
    ```
