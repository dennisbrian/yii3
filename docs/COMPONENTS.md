# 🧩 Component Reference

## 🌐 Web Features (`src/Web/`)

The web layer is organized by feature. Each directory contains the Action (Controller logic) and Template (View) for that feature.

### `Auth`
Handles user authentication.
- **Location:** `src/Web/Auth/`
- **Key Files:**
  - `LoginAction.php`: Handles GET (form) and POST (submit).
  - `LogoutAction.php`: Logs user out.
  - `login.php`: Login form template.

### `Dashboard`
Protected user area.
- **Location:** `src/Web/Dashboard/`
- **Responsibilities:** Display user-specific data.
- **Key Files:** `DashboardAction.php`, `dashboard.php`

### `HomePage`
Public landing page.
- **Location:** `src/Web/HomePage/`
- **Key Files:** `Action.php`

### `Shared`
Common UI elements.
- **Location:** `src/Web/Shared/`
- **Contents:** Layouts, partials.

---

## 🧠 Domain Components

### `User` (Identity)
Handles Authentication & Session state.
- **Location:** `src/User/`
- **Responsibilities:** Adapts the domain user to `yiisoft/auth` IdentityInterface.
- **Key Files:**
  - `Identity.php`: Implements `IdentityInterface`.
  - `IdentityRepository.php`: Loads identity from storage.

### `Entity`
Business Domain Models.
- **Location:** `src/Entity/`
- **Responsibilities:** Pure, immutable business objects. Decoupled from DB and HTTP.
- **Key Files:**
  - `User.php`: The User domain model.
