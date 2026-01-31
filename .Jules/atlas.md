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

## 2024-05-22 - Documentation Gaps & Schema Mapping

**Discovery:** `README.md` referenced `docs/DATABASE_SCHEMA.md` but the file did not exist. The database schema was only defined in `migrations/`.
**Implication:** New developers would have to reverse-engineer the schema from migration files.
**Documentation Action:** Created `docs/DATABASE_SCHEMA.md` mapping the `user` table and relationships, including a Mermaid ER diagram.

**Discovery:** The application exposes specific Web Routes but lacks a consolidated reference.
**Implication:** It's hard to know what URLs are available without grepping `routes.php`.
**Documentation Action:** Created `docs/API_REFERENCE.md` to list all available routes and their corresponding Action classes.

**Discovery:** `docker/dev/.env` defines critical environment variables like `APP_ENV` and `DEV_PORT` which were not documented in `SETUP.md`.
**Implication:** Developers might not know how to configure the environment or change ports.
**Documentation Action:** Added an "Environment Variables" section to `docs/SETUP.md`.
