# 📡 API / Route Reference

This document details the application's available routes and endpoints.
Defined in: `config/common/routes.php`

## 🌍 Public Routes

Access to these routes does not require authentication.

| Method | Path | Action Class | Name | Description |
|--------|------|--------------|------|-------------|
| `GET` | `/` | `App\Web\HomePage\Action` | `home` | Landing page. |
| `GET`, `POST` | `/login` | `App\Web\Auth\LoginAction` | `login` | Login form and submission handler. |
| `GET` | `/logout` | `App\Web\Auth\LogoutAction` | `logout` | Logs the user out. |

## 🔒 Protected Routes

These routes require the user to be authenticated via the `Authentication` middleware.

| Method | Path | Action Class | Name | Description |
|--------|------|--------------|------|-------------|
| `GET` | `/dashboard` | `App\Web\Dashboard\DashboardAction` | `dashboard` | User dashboard page. |

## 🛠️ Middleware

The Global Middleware Pipeline (configured in `config/web/application.php` or similar) typically includes:
1.  **ErrorCatcher:** Catches exceptions and renders error pages.
2.  **Session:** Manages user sessions.
3.  **Csrf:** Protects against Cross-Site Request Forgery.
4.  **Router:** Matches the URL to a route.
5.  **Authentication:** (Applied per-route or globally) Verifies user identity.

## 📝 Request/Response Examples

### Login Request (POST `/login`)

**Payload:**
```json
{
  "_csrf": "...",
  "Login": {
    "login": "user@example.com",
    "password": "mysecretpassword"
  }
}
```

**Response (Success):**
- **Status:** `302 Found`
- **Location:** `/dashboard`

**Response (Failure):**
- **Status:** `422 Unprocessable Entity` (if validation fails) or `200 OK` (if re-rendering form with errors)
