# 📡 API / Route Reference

This document outlines the available HTTP routes and endpoints in the application.

## 🌐 Web Routes

These routes are defined in `config/common/routes.php`.

| Method | Path | Action Class | Description |
| :--- | :--- | :--- | :--- |
| `GET` | `/` | `App\Web\HomePage\Action` | **Home Page.** Displays the landing page. |
| `GET`, `POST` | `/login` | `App\Web\Auth\LoginAction` | **Login.** Displays login form (GET) and processes authentication (POST). |
| `GET` | `/logout` | `App\Web\Auth\LogoutAction` | **Logout.** Logs the user out and redirects. |
| `GET` | `/dashboard` | `App\Web\Dashboard\DashboardAction` | **Dashboard.** Protected area for authenticated users. Requires `Authentication` middleware. |

## 🔒 Middleware

*   **Authentication:** The `/dashboard` route uses `Yiisoft\Auth\Middleware\Authentication` to ensure only logged-in users can access it.
