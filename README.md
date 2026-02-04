# Yii3 Web Application with Tailwind CSS

Welcome to the **Yii3 Web Application** project! 🚀

This repository contains a modern web application built with the **Yii3 Framework** and **Tailwind CSS**. It is designed with a Domain-Driven Design (DDD) inspired structure and is fully containerized with Docker.

## 📚 Documentation

Detailed documentation is available in the `docs/` directory:

-   **[Architecture Overview](docs/ARCHITECTURE.md):** Understand the system design, directory structure, and configuration.
-   **[Directory Structure](docs/DIRECTORY_STRUCTURE.md):** A map of the codebase.
-   **[Setup Guide](docs/SETUP.md):** Detailed instructions for setting up the development environment.
-   **[Database Schema](docs/DATABASE_SCHEMA.md):** Tables, columns, and relationships.

## 🛠️ Tech Stack

-   **Backend:** [Yii3 Framework](https://github.com/yiisoft) (PHP 8.2+)
-   **Frontend:** [Tailwind CSS](https://tailwindcss.com/)
-   **Database:** MySQL (via `yiisoft/db`)
-   **Testing:** Codeception
-   **Infrastructure:** Docker & Docker Compose

## 🚀 Quick Start

This project uses a `Makefile` to simplify common tasks. Ensure you have **Docker** and **Docker Compose** installed.

### 1. Build the Environment
```bash
make build
```

### 2. Start the Application
```bash
make up
```
The application will be available at http://localhost:8080 (default).

### 3. Install Dependencies
```bash
make composer install
```

### 4. Run Migrations (if applicable)
```bash
make yii migrate/up
```

### 5. Compile Assets
```bash
# For development (watch mode)
npm run dev

# For production
npm run build
```
*(Note: You might need to run npm commands locally or inside the container via `make shell`)*

## 🧪 Testing

Run the test suite:

```bash
make test
```

## 📂 Key Directories

-   `src/`: Application source code.
    -   `Web/`: HTTP handlers and templates (Feature-based).
    -   `User/`: User domain logic.
-   `config/`: Application configuration.
-   `docker/`: Docker environment configuration.

---
*Mapped by [Atlas](https://github.com/yiisoft/app) 📚*
