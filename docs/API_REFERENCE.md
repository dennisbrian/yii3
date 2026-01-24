# 📡 API / Web Interface Reference

This application primarily serves HTML content via the Web Interface, but these routes constitute the public interface of the application.

## 🌍 Web Routes

Defined in `config/common/routes.php`.

| Method | URI | Route Name | Action | Auth Required? | Description |
|--------|-----|------------|--------|----------------|-------------|
| `GET` | `/` | `home` | `App\Web\HomePage\Action` | No | Public landing page. |
| `GET` | `/login` | `login` | `App\Web\Auth\LoginAction` | No* | Login form. *Redirects if already logged in.* |
| `POST` | `/login` | `login` | `App\Web\Auth\LoginAction` | No | Process login credentials. |
| `GET` | `/logout` | `logout` | `App\Web\Auth\LogoutAction` | Yes | Logs out the current user. |
| `GET` | `/dashboard` | `dashboard` | `App\Web\Dashboard\DashboardAction` | **Yes** | User dashboard. Protected by `Authentication` middleware. |

## 🔒 Authentication

-   **Mechanism:** Session-based (Cookies).
-   **Middleware:** `Yiisoft\Auth\Middleware\Authentication` protects routes.
-   **Redirect:** Unauthenticated users accessing protected routes are redirected to `/login` (configured in `config/web/application.php` or similar middleware setup).
