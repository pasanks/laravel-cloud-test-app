# Task Manager - Laravel Cloud & Vapor Demo App

A full-featured task management web application built with **Laravel 13** and **MySQL**, designed to demonstrate CRUD operations and deployment on **Laravel Cloud** and **Laravel Vapor**.

---

## What This App Does

Task Manager is a simple but complete web application that lets you create, read, update, and delete tasks. It demonstrates core Laravel features including Eloquent ORM, Blade templating, form validation, database migrations, and MySQL integration.

### Features

- **Create Tasks** - Add new tasks with title, description, status, priority, and due date
- **View Tasks** - Browse all tasks in a paginated table with sorting
- **Filter Tasks** - Filter by status (Pending, In Progress, Completed) and priority (Low, Medium, High)
- **Edit Tasks** - Update any task's details
- **Delete Tasks** - Remove tasks with confirmation dialog
- **Task Detail View** - View full task details including timestamps
- **Health Check Endpoint** - `/health` endpoint for monitoring and deployment checks
- **Database Seeder** - Pre-built sample data for quick testing
- **Laravel Cloud Ready** - Includes `cloud.yaml` for one-click deployment
- **Laravel Vapor Ready** - Includes `vapor.yml` for serverless deployment on AWS Lambda

### Task Fields

| Field       | Type   | Description                                      |
|-------------|--------|--------------------------------------------------|
| Title       | String | Required. The name of the task (max 255 chars)   |
| Description | Text   | Optional. Detailed description of the task       |
| Status      | Enum   | `pending`, `in_progress`, or `completed`         |
| Priority    | Enum   | `low`, `medium`, or `high`                       |
| Due Date    | Date   | Optional. When the task should be completed      |

### Routes

| Method | URI              | Action  | Description          |
|--------|------------------|---------|----------------------|
| GET    | `/`              | redirect| Redirects to tasks   |
| GET    | `/tasks`         | index   | List all tasks       |
| GET    | `/tasks/create`  | create  | Show create form     |
| POST   | `/tasks`         | store   | Save new task        |
| GET    | `/tasks/{id}`    | show    | View task details    |
| GET    | `/tasks/{id}/edit` | edit  | Show edit form       |
| PUT    | `/tasks/{id}`    | update  | Update existing task |
| DELETE | `/tasks/{id}`    | destroy | Delete a task        |
| GET    | `/health`        | -       | Health check (JSON)  |

---

## Local Development Setup

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 8.0+
- Node.js 18+ and npm (for asset compilation)

### Step 1: Clone the Repository

```bash
git clone https://github.com/pasanks/laravel-cloud-test-app.git
cd laravel-cloud-test-app
```

### Step 2: Install Dependencies

```bash
composer install
npm install
```

### Step 3: Configure Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your MySQL credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_tasks
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 4: Create the Database

```bash
mysql -u root -p -e "CREATE DATABASE laravel_tasks;"
```

### Step 5: Run Migrations and Seed

```bash
php artisan migrate
php artisan db:seed
```

### Step 6: Start the Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

---

## Project Structure

```
app/
├── Http/Controllers/
│   └── TaskController.php      # CRUD controller with validation
├── Models/
│   └── Task.php                # Eloquent model with fillable fields
database/
├── migrations/
│   └── *_create_tasks_table.php # Task table schema
├── seeders/
│   ├── DatabaseSeeder.php       # Main seeder
│   └── TaskSeeder.php           # Sample task data
resources/views/
├── layouts/
│   └── app.blade.php            # Base layout with CSS
├── tasks/
│   ├── index.blade.php          # Task list with filters
│   ├── create.blade.php         # Create task form
│   ├── edit.blade.php           # Edit task form
│   └── show.blade.php           # Task detail view
routes/
└── web.php                      # Route definitions
cloud.yaml                       # Laravel Cloud configuration
vapor.yml                        # Laravel Vapor configuration
```

---

## Deploying to Laravel Cloud - Step by Step Guide

### What is Laravel Cloud?

Laravel Cloud is a fully managed deployment platform built specifically for Laravel applications. It handles infrastructure provisioning, scaling, TLS certificates, and deployments automatically.

### Step 1: Create a Laravel Cloud Account

1. Go to [cloud.laravel.com](https://cloud.laravel.com)
2. Sign up for an account
3. Connect your **GitHub account** when prompted

### Step 2: Push Your Code to GitHub

Make sure your code is pushed to your GitHub repository:

```bash
git add .
git commit -m "Initial Laravel task manager app"
git push origin main
```

### Step 3: Create a New Project

1. In the Laravel Cloud dashboard, click **"New Project"**
2. Select your GitHub repository (`pasanks/laravel-cloud-test-app`)
3. Give your project a name (e.g., "Task Manager")
4. Click **Create**

### Step 4: Create a MySQL Database

1. In your project dashboard, navigate to **"Databases"**
2. Click **"Create Database"**
3. Choose **MySQL** as the database type
4. Select a **region** (choose the same region as your environment for lowest latency)
5. Select a **size** (the smallest tier works fine for testing)
6. Click **Create** and wait for provisioning to complete

### Step 5: Create an Environment

1. Go to **"Environments"** in your project
2. Click **"Create Environment"**
3. Choose a name (e.g., `production` or `staging`)
4. Select the **branch** to deploy from (e.g., `main`)
5. Select the **region** (same as your database)

### Step 6: Attach the Database

1. In your environment settings, find the **"Databases"** or **"Resources"** section
2. **Attach** the MySQL database you created in Step 4
3. Laravel Cloud will automatically inject the `DATABASE_URL` environment variable

> **Note:** When a database is attached, Laravel Cloud auto-injects `DATABASE_URL`. Laravel's `config/database.php` already supports the `DB_URL` / `url` key, so no code changes are needed.

### Step 7: Set Environment Variables

In your environment's **Settings > Environment Variables**, add the following:

| Variable    | Value                          | Notes                              |
|-------------|--------------------------------|------------------------------------|
| `APP_NAME`  | `Task Manager`                 | Your app name                      |
| `APP_ENV`   | `production`                   | Set to `production`                |
| `APP_KEY`   | `base64:...`                   | Generate with `php artisan key:generate --show` |
| `APP_URL`   | `https://your-app.laravel.cloud` | Your environment's URL           |
| `APP_DEBUG` | `false`                        | Always `false` in production       |
| `DB_CONNECTION` | `mysql`                    | Database driver                    |

> **Important:** `APP_KEY` must be set manually. Generate it locally with `php artisan key:generate --show` and paste the output.

### Step 8: Configure cloud.yaml (Already Done)

This repo already includes a `cloud.yaml` file that tells Laravel Cloud how to build and deploy:

```yaml
build:
  php-version: "8.4"
  build-commands:
    - npm ci
    - npm run build
deploy:
  commands:
    - php artisan migrate --force
    - php artisan config:cache
    - php artisan route:cache
    - php artisan view:cache
scheduler:
  enabled: false
```

**What each section does:**
- **build**: Sets the PHP version and runs asset compilation during the build phase
- **deploy**: Runs database migrations and caches configuration after deployment (these commands require database access, which is why they're in `deploy` and not `build`)
- **scheduler**: Disabled since this app doesn't use scheduled tasks

### Step 9: Deploy

There are two ways to trigger a deployment:

**Automatic (recommended):** Simply push to the configured branch:
```bash
git push origin main
```

**Manual:** Click the **"Deploy"** button in the Laravel Cloud dashboard.

### Step 10: Verify Deployment

1. Once the deployment is complete, visit your environment's URL (e.g., `https://your-app.laravel.cloud`)
2. You should see the Task Manager interface
3. Check the health endpoint: `https://your-app.laravel.cloud/health`
4. Try creating, editing, and deleting tasks to verify database connectivity

### Troubleshooting

| Issue | Solution |
|-------|----------|
| 500 error after deploy | Check that `APP_KEY` is set in environment variables |
| Database connection error | Verify the database is attached to the environment |
| Migrations failed | Check the deployment logs for specific migration errors |
| Assets not loading | Ensure `npm ci` and `npm run build` are in `build-commands` |
| Health check failing | Verify the `/health` route exists and returns 200 |

### Optional: Seed the Database on First Deploy

If you want sample data, you can add the seed command to your deploy commands in `cloud.yaml`:

```yaml
deploy:
  commands:
    - php artisan migrate --force
    - php artisan db:seed --force
    - php artisan config:cache
    - php artisan route:cache
    - php artisan view:cache
```

> **Note:** Remove the seed command after the first deployment to avoid duplicate data.

---

## Deploying to Laravel Vapor - Step by Step Guide

### What is Laravel Vapor?

Laravel Vapor is a serverless deployment platform for Laravel, powered by **AWS Lambda**. It provides auto-scaling, zero server management, and pay-per-use pricing. Your application runs on AWS infrastructure without managing any servers.

### Prerequisites

- A [Laravel Vapor](https://vapor.laravel.com) account
- An **AWS account** linked to Vapor
- PHP 8.2+ and Composer installed locally

### Step 1: Install Vapor Core (Already Done)

This branch already includes the Vapor Core package:

```bash
composer require laravel/vapor-core
```

### Step 2: Install the Vapor CLI

Install the Vapor CLI globally on your local machine:

```bash
composer global require laravel/vapor-cli
```

Make sure the Composer global bin directory is in your PATH:

```bash
# Add to your .bashrc or .zshrc:
export PATH="$HOME/.composer/vendor/bin:$PATH"
```

### Step 3: Authenticate with Vapor

Log in to your Vapor account from the terminal:

```bash
vapor login
```

Enter your Vapor credentials when prompted.

### Step 4: Link Your AWS Account

If you haven't already, link your AWS account in the [Vapor dashboard](https://vapor.laravel.com):

1. Go to **Team Settings > AWS Accounts**
2. Click **"Link AWS Account"**
3. Follow the guided setup to create the necessary IAM role

### Step 5: Create a Vapor Project

Create a new project in the Vapor dashboard or via CLI:

```bash
vapor init
```

This will ask you to name the project and link it to your AWS account.

### Step 6: Configure vapor.yml (Already Done)

This repo already includes a `vapor.yml` file:

```yaml
id: 75199
name: pasan-test-project
environments:
    production:
        memory: 1024
        cli-memory: 512
        runtime: 'php-8.4:al2023'
        build:
            - 'composer install --no-dev'
            - 'php artisan event:cache'
          # - 'npm ci && npm run build && rm -rf node_modules'
    staging:
        memory: 1024
        cli-memory: 512
        runtime: 'php-8.4:al2023'
        build:
            - 'composer install --no-dev'
            - 'php artisan event:cache'
          # - 'npm ci && npm run build && rm -rf node_modules'
```

**What each setting does:**
- **id**: Your Vapor project ID (update this to your project's actual ID)
- **name**: Project name in Vapor
- **memory**: Lambda function memory allocation in MB (1024 = 1GB)
- **cli-memory**: Memory for CLI commands (artisan, migrations)
- **runtime**: PHP version and OS (`php-8.4:al2023` = PHP 8.4 on Amazon Linux 2023)
- **build**: Commands that run during the build phase

> **Note:** Update the `id` field to match your actual Vapor project ID after creating the project.

### Step 7: Create a Database

Create a MySQL database via the Vapor dashboard or CLI:

```bash
vapor database my-database
```

Choose:
- **Engine**: MySQL 8.0
- **Instance size**: Start small for testing (e.g., `db.t3.micro`)
- **Region**: Same as your Lambda functions

Then, in the Vapor dashboard, go to your **environment settings** and attach the database. Vapor will auto-inject `DB_*` environment variables.

### Step 8: Set Environment Variables

In the Vapor dashboard, navigate to your environment and set:

| Variable        | Value                          | Notes                                  |
|-----------------|--------------------------------|----------------------------------------|
| `APP_NAME`      | `Task Manager`                 | Your app name                          |
| `APP_KEY`       | `base64:...`                   | Generate with `php artisan key:generate --show` |
| `DB_CONNECTION`  | `mysql`                       | Database driver                        |
| `CACHE_STORE`   | `dynamodb`                     | Recommended for Vapor                  |
| `SESSION_DRIVER` | `cookie` or `dynamodb`        | Recommended for serverless             |
| `QUEUE_CONNECTION` | `sqs`                       | Recommended for Vapor                  |

> **Important:** On Vapor, filesystem is **read-only** except `/tmp`. Use S3 for file storage and DynamoDB/cookie for sessions.

### Step 9: Deploy

Deploy to production:

```bash
vapor deploy production
```

Or deploy to staging:

```bash
vapor deploy staging
```

Vapor will:
1. Run build commands (`composer install`, etc.)
2. Package your application
3. Upload to AWS S3
4. Deploy to Lambda
5. Run any pending migrations (if configured)

### Step 10: Run Migrations

After the first deployment, run migrations:

```bash
vapor command production --command="php artisan migrate --force"
```

Or to seed the database:

```bash
vapor command production --command="php artisan db:seed --force"
```

### Step 11: Verify Deployment

1. Vapor will provide a URL (e.g., `https://xxxxx.vapor-farm-xxxxx.com`)
2. Visit the URL to see the Task Manager
3. You can also set a **custom domain** in the Vapor dashboard
4. Check the health endpoint: `https://your-domain.com/health`

### Vapor-Specific Considerations

| Topic | Details |
|-------|---------|
| **File Storage** | Use S3 instead of local disk (`FILESYSTEM_DISK=s3`) |
| **Sessions** | Use `cookie` or `dynamodb` (not `file`) |
| **Cache** | Use `dynamodb` (not `file`) |
| **Queues** | Use SQS (`QUEUE_CONNECTION=sqs`) |
| **File Uploads** | Must go to S3 — Lambda has a read-only filesystem |
| **Max Execution** | Lambda timeout is 15 minutes max |
| **Cold Starts** | First request after inactivity may be slower (~1-2s) |

### Vapor Troubleshooting

| Issue | Solution |
|-------|----------|
| 500 error | Check `vapor logs production` for details |
| Database timeout | Ensure DB and Lambda are in the same VPC/region |
| File write errors | Use S3 for storage, DynamoDB for cache/sessions |
| Out of memory | Increase `memory` in `vapor.yml` |
| Build failed | Check build output with `vapor deploy production --verbose` |

### Useful Vapor CLI Commands

```bash
vapor login                          # Authenticate
vapor deploy production              # Deploy to production
vapor deploy staging                 # Deploy to staging
vapor logs production                # View production logs
vapor command production             # Run artisan commands
vapor rollback production            # Rollback to previous deployment
vapor env:pull production            # Download .env file
vapor env:push production            # Upload .env file
vapor database:shell my-database     # Connect to database
vapor tinker production              # Run Tinker remotely
```

---

## Running Tests

```bash
php artisan test
```

---

## Tech Stack

- **Framework:** Laravel 13
- **Language:** PHP 8.4
- **Database:** MySQL 8.0+
- **Frontend:** Blade templates with inline CSS
- **Deployment:** Laravel Cloud / Laravel Vapor (AWS Lambda)
- **Monitoring:** Laravel Nightwatch

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
