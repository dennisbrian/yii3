# 📡 API & Route Reference

This document lists the defined routes in the application.

**Source:** `config/common/routes.php`

## 🌐 Public Routes

| Method | Path | Action Class | Route Name | Description |
|--------|------|--------------|------------|-------------|
| `GET` | `/` | `App\Web\HomePage\Action` | `home` | The landing page. |
| `GET`, `POST` | `/login` | `App\Web\Auth\LoginAction` | `login` | Login form and submission handler. |
| `GET` | `/logout` | `App\Web\Auth\LogoutAction` | `logout` | Logs the user out. |

## 🔒 Protected Routes

These routes require Authentication (middleware: `Yiisoft\Auth\Middleware\Authentication`).

| Method | Path | Action Class | Route Name | Description |
|--------|------|--------------|------------|-------------|
| `GET` | `/dashboard` | `App\Web\Dashboard\DashboardAction` | `dashboard` | User dashboard. |

## 🔗 Route Definition Example

Routes are defined using the `Yiisoft\Router\Route` class:

```php
Route::get('/dashboard')
    ->middleware(Authentication::class) // Requires Auth
    ->action(Web\Dashboard\DashboardAction::class)
    ->name('dashboard');
```
