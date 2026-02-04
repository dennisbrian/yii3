# 🌐 Web Routes Reference

This document lists the available HTTP routes and their corresponding Action classes.

## 📌 Public Routes

| Route | Method | Action Class | Description |
| :--- | :--- | :--- | :--- |
| `/` | `GET` | `App\Web\HomePage\Action` | The main landing page. |
| `/login` | `GET`, `POST` | `App\Web\Auth\LoginAction` | User login form and processing. |
| `/logout` | `GET` | `App\Web\Auth\LogoutAction` | Logs out the current user. |

## 🔒 Protected Routes

These routes require the user to be authenticated (via `Yiisoft\Auth\Middleware\Authentication`).

| Route | Method | Action Class | Description |
| :--- | :--- | :--- | :--- |
| `/dashboard` | `GET` | `App\Web\Dashboard\DashboardAction` | The user dashboard page. |

## 🧩 Action details

### HomePage Action
- **Class:** `App\Web\HomePage\Action`
- **View:** `src/Web/HomePage/home.php` (typically)
- **Purpose:** Renders the public welcome screen.

### Login Action
- **Class:** `App\Web\Auth\LoginAction`
- **View:** `src/Web/Auth/login.php`
- **Purpose:**
    - `GET`: Renders the login form.
    - `POST`: Validates credentials using `UserService` and logs the user in via `CurrentUser`.

### Dashboard Action
- **Class:** `App\Web\Dashboard\DashboardAction`
- **View:** `src/Web/Dashboard/dashboard.php`
- **Purpose:** Renders the private dashboard area. Only accessible if `Authentication` middleware passes.
