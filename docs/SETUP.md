# 🛠️ Setup Guide

This guide covers how to set up the development environment, run the application, and execute tests.

## 📋 Project Requirements

While Docker handles most dependencies, you should know the underlying technology stack:
-   **PHP:** 8.2 - 8.5
-   **Node.js:** Latest LTS recommended (for Tailwind CSS)
-   **Database:** MySQL (provided via Docker)

## ⚙️ Prerequisites

To run this project, you only need:
-   **Docker** (v20.10+)
-   **Docker Compose** (v2.0+)
-   **Make** (Standard on Linux/Mac; use WSL or Git Bash on Windows)

## 🚀 Quick Start

The project uses a `Makefile` to automate Docker commands.

### 1. Build the Docker Images
```bash
make build
```
This builds the development images defined in `docker/compose.yml` and `docker/dev/compose.yml`.

### 2. Start the Environment
```bash
make up
```
This starts the containers in detached mode. The application will be accessible at `http://localhost:8080`.

### 3. Install Backend Dependencies
```bash
make composer install
```
This runs `composer install` inside the application container.

### 4. Setup Frontend Assets
You have two options for frontend assets:

**Option A: Run locally (requires Node.js)**
```bash
npm install
npm run dev  # Watch mode
# OR
npm run build # One-off build
```

**Option B: Run inside the container**
```bash
make shell
# Inside the container:
npm install
npm run build
exit
```

## 🎮 Common Commands

| Command | Description |
|---------|-------------|
| `make up` | Start the development server (background) |
| `make down` | Stop and remove containers |
| `make stop` | Stop containers without removing them |
| `make shell` | Open a Bash shell inside the `app` container |
| `make yii [cmd]` | Run a Yii console command (e.g., `make yii list`) |
| `make composer [cmd]` | Run a Composer command (e.g., `make composer require ...`) |
| `make test` | Run the full test suite via Codeception |

## 📦 Database Management

The database container is spun up automatically with `make up`.

**Run Migrations:**
```bash
make yii migrate
```

**Create a Migration:**
```bash
make yii migrate/create [name]
```

## 🧪 Running Tests

To run all tests:
```bash
make test
```

To run a specific test suite (e.g., Unit):
```bash
make test unit
```

## 🧹 Code Quality

**Run Static Analysis (Psalm):**
```bash
make psalm
```

**Run Coding Standards Fixer:**
```bash
make cs-fix
```

## ⚠️ Troubleshooting

**Port Conflicts:**
If port `8080` is in use, check `docker/.env` or override it by creating a `.env` file in the root (if supported) or modifying `docker/compose.yml`.

**Permission Issues:**
If you encounter permission errors on Linux, ensure your user ID matches the container's user. The `Makefile` attempts to handle this automatically:
```makefile
export UID=$(shell id -u)
export GID=$(shell id -g)
```

**"Host not found" in Database:**
Ensure the `mysql` service is running (`docker ps`) and that `config/common/params.php` (or env vars) points to the correct host (usually `mysql` or `db` in Docker).
