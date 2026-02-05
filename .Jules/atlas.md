# 📖 ATLAS' JOURNAL

## 2024-05-22 - Initial Reconnaissance: Yii3 & Feature-Based Structure

**Discovery:** This is a **Yii3** application, which differs significantly from Yii2. It uses a **feature-based directory structure** in `src/Web/` (e.g., `src/Web/HomePage`, `src/Web/Auth`) rather than the traditional flat `controllers/`, `views/` structure.
**Implication:** Developers coming from Yii2 or standard MVC frameworks might look for a `controllers` directory and get lost. The `src/Web` directory mixes Actions (Controllers) and Templates (Views) by feature.
**Documentation Action:** Will explicitly document this pattern in `ARCHITECTURE.md` and `DIRECTORY_STRUCTURE.md`.

**Discovery:** Configuration is handled by `yiisoft/config` with a **merge plan** defined in `config/configuration.php`.
**Implication:** Configs are not just simple files; they are assembled from `common`, `web`, `console` and environment specific files. "Where is the db config?" is a complex answer involving `config/common/params.php` or `config/environments/`.
**Documentation Action:** Must explain the Config Plugin and where to find key settings (DB, Debug, etc.) in `ARCHITECTURE.md`.

**Discovery:** Domain logic is separated into `src/User` (and potentially others), distinct from the Web layer.
**Implication:** Keeps business logic decoupled from HTTP/Web concerns.
**Documentation Action:** Highlight the Domain vs. Web separation.

## 2024-05-22 - Documentation Expansion

**Discovery:** Missing `DATABASE_SCHEMA.md`.
**Implication:** Developers have to read migrations to understand the data model.
**Documentation Action:** Created `DATABASE_SCHEMA.md` with a Mermaid ERD for the `user` table.

**Discovery:** `src/Environment.php` and `src/autoload.php` were undocumented in the structure.
**Implication:** These are critical for bootstrapping the application.
**Documentation Action:** Added them to `DIRECTORY_STRUCTURE.md`.

**Discovery:** Visualizing the Request Lifecycle and Config Merge Plan is crucial for understanding Yii3's complexity.
**Implication:** Text alone is insufficient.
**Documentation Action:** Added Mermaid diagrams to `ARCHITECTURE.md`.

**Discovery:** Test suite has environmental issues in the current sandbox (`Dom\HTMLDocument` missing).
**Implication:** Running tests requires `composer install --ignore-platform-reqs`. Tests may fail due to environment or content mismatches (Homepage content).
**Documentation Action:** Noted for future reference; did not modify tests to avoid scope creep.

## 2024-05-23 - Console & Test Structure Discovery

**Discovery:** `src/Console/` contains `CreateAdminCommand` and `HelloCommand`, but they are undocumented.
**Implication:** Developers may not know how to create admin users or run basic CLI tasks.
**Documentation Action:** Creating `CLI_REFERENCE.md` to document these commands.

**Discovery:** `docs/DIRECTORY_STRUCTURE.md` lists `Acceptance` tests, but the actual directory contains `Web` tests. `Console` tests are also present but undocumented.
**Implication:** The documentation is misleading regarding the test suite structure.
**Documentation Action:** Updating `DIRECTORY_STRUCTURE.md` to match the actual file system.

## 2024-05-23 - Security & Frontend Structure

**Discovery:** RBAC uses a **Hybrid Storage** model: static roles in PHP files (`ItemsStorage`), dynamic assignments in DB (`AssignmentsStorage`).
**Implication:** This is a crucial architectural decision. Developers might look for role definitions in the DB and not find them, or try to edit files to change user roles.
**Documentation Action:** Documented in `ARCHITECTURE.md` with a Mermaid diagram.

**Discovery:** The main layout and global assets are nested in `src/Web/Shared/Layout/Main/`.
**Implication:** It's not immediately obvious where the "master" HTML template lives.
**Documentation Action:** Clarified in `DIRECTORY_STRUCTURE.md` and added details to `COMPONENTS.md`.
