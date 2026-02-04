# 🤖 AGENTS.md - The Codebase Guide

This file is a high-level guide for AI agents (and humans) working on this Yii3 codebase.

## 🎯 Quick Architecture Summary

*   **Framework:** Yii3 (Not Yii2).
*   **Structure:** Feature-based (`src/Web/[Feature]/Action.php`), NOT Controller-based.
*   **Domain:** strictly separated in `src/Entity` (Business) and `src/User` (Auth).
*   **Frontend:** Tailwind CSS (compile via `npm run build` or `make build`).
*   **Config:** Plugin-based `yiisoft/config`. No single `config/web.php`.

## 🧭 Directory Map

*   `src/Web/`: **Features live here.** If adding a page, look here.
*   `src/Entity/`: **Business Logic.** Immutable domain entities.
*   `src/User/`: **Authentication Identity.** Only for login/session.
*   `config/`: **Configuration.** merged via `configuration.php`.
*   `tests/`: **Codeception.** Run with `make test`.

## ⚠️ Critical Conventions (Do's & Don'ts)

### ✅ DO:
*   **Create single-action classes** in `src/Web/[Feature]/`.
*   **Use Dependency Injection** in constructors.
*   **Keep Entities Immutable.** Use `withProperty()` methods.
*   **Use `make` commands** for build and test operations.
*   **Check `docs/COMPONENTS.md`** if confused about User vs Identity.

### ❌ DON'T:
*   **Don't look for `controllers/`**. They don't exist.
*   **Don't extend `ActiveRecord`**. Entities are plain PHP classes.
*   **Don't edit `assets/`**. Edit `src/input.css` instead.
*   **Don't assume Yii2 patterns** (e.g., `Yii::$app`). It's gone.

## 🛠️ Common Tasks

*   **Add Route:** Edit `config/common/routes.php`.
*   **Add Migration:** `make yii migrate/create [name]`.
*   **Run Tests:** `make test`.
*   **View Docs:** See `docs/` for deep dives.

---
*Maintained by Atlas 📚*
