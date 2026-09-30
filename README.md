# NEXORA — Business OS

**The operating system for modern business.**

Nexora is a business operations platform that lets you run sales, inventory, finance, customers, purchasing, and analytics from one connected workspace. Built with Laravel for businesses that move fast.

## Features

- **Business Dashboard**: revenue, orders, and product overview at a glance
- **Sales & Orders**: create and track customer orders end to end
- **Inventory**: multi-warehouse stock levels, stock movements, and inventory health
- **Products**: product catalog with categories and variants
- **Finance**: invoices, payments, and expense tracking
- **Purchasing**: suppliers and purchase orders
- **Customers**: customer records and order history
- **Analytics**: business insights and performance reports
- **Team & Access Control**: roles and permissions for every team member
- **Audit Logs**: a traceable record of important system activity
- **Notifications**: in-app alerts and system notifications
- **Global Search**: find records quickly across the workspace
- **Multi-company Support**: separate company workspaces with their own users and data

## Tech Stack

- **Backend:** Laravel (PHP)
- **Frontend:** Blade, Tailwind CSS, Vite
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Testing:** Pest

## Requirements

- PHP (check `composer.json` for the required version)
- Composer
- Node.js and npm
- MySQL (for example via XAMPP)

## Installation

```bash
# 1. Clone the repository
git clone https://github.com/arsanara11/nexora-saas.git
cd nexora-saas

# 2. Install dependencies
composer install
npm install

# 3. Set up the environment file
cp .env.example .env        # on Windows: copy .env.example .env
php artisan key:generate
```

Open `.env` and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nexora
DB_USERNAME=root
DB_PASSWORD=
```

Create an empty database named `nexora`, then run:

```bash
# 4. Run migrations and seed demo data
php artisan migrate --seed

# 5. Start the development servers
npm run dev
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

## Demo Data

The seeder (`NexoraSeeder`) creates sample data so you can explore the app right away. Demo accounts use a default password, so **change all default passwords before deploying to production**.

## Running Tests

```bash
php artisan test
```

## Project Structure

```
app/            Controllers, models, middleware, notifications
database/       Migrations, factories, seeders
resources/      Blade views, CSS, JavaScript
routes/         Web and auth routes
tests/          Feature and unit tests
```

## Security

- Never commit your `.env` file.
- Change all seeded/default passwords in production.
- If you find a security issue, please open a private report instead of a public issue.
