# 📚 Atlas Journal

## 2026-01-16 - Architectural Boundaries

**Discovery:** Strict separation between Authentication Identity and Domain Entities.
**Implication:** `App\User\Identity` is purely for the `yiisoft/auth` and `yiisoft/user` packages to handle session and login state. `App\Entity\User` is the actual business domain model.
**Documentation Action:** Documented in `ARCHITECTURE.md` and `COMPONENTS.md` to prevent developers from conflating the two.

## 2026-01-16 - Feature-Based Web Layer

**Discovery:** `src/Web` is organized by Feature (e.g., `Auth`, `HomePage`) rather than technical layer (Controller/View).
**Implication:** Each feature directory is self-contained with its Actions and Templates.
**Documentation Action:** Reinforced in `DIRECTORY_STRUCTURE.md` and `COMPONENTS.md`.

## 2026-01-16 - Configuration Strategy

**Discovery:** Configuration is not monolithic but composed via `yiisoft/config` using a merge plan (`config/configuration.php`).
**Implication:** Adding new configuration requires understanding the merge plan and placing files in `config/common` or `config/web`.
**Documentation Action:** Already noted in `ARCHITECTURE.md`, confirmed accuracy.
