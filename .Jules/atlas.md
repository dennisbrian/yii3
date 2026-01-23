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

## 2024-05-22 - Deep Dive: User Domain & Database

**Discovery:** Strict separation between `App\Entity\User` (Domain Model) and `App\User\Identity` (Authentication Identity).
**Implication:** The class used for business logic is not the same as the one used for the session/auth. Changes to the business entity don't automatically break auth, but data syncing logic (via Repository) is crucial.
**Documentation Action:** Created `docs/COMPONENTS.md` to detail this distinction.

**Discovery:** Database migrations use `RevertibleMigrationInterface` with `MigrationBuilder`.
**Implication:** Migrations are more fluent and explicit than Yii2. No `safeUp`/`safeDown`, just `up` and `down` with the builder object.
**Documentation Action:** Documented this in `docs/DATABASE_SCHEMA.md`.
