<div align="center">

# 💰 Pocket — Personal Finance Tracker

A **Laravel-based modular personal finance application** for tracking income and expenses with multi-user support, role-based access control, multi-language UI, and detailed period-wise financial summaries.

[![PHP](https://img.shields.io/badge/PHP-7.3%2B%20%7C%208.0%2B-blue?logo=php)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-8.x-red?logo=laravel)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?logo=mysql)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

</div>

---

## Table of Contents

- [About the Project](#about-the-project)
- [Tech Stack](#tech-stack)
- [Architecture Overview](#architecture-overview)
- [Module Map](#module-map)
- [Application Flow](#application-flow)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [First-Run Seeding & Admin Setup](#first-run-seeding--admin-setup)
- [Running the Application](#running-the-application)
- [Usage Guide](#usage-guide)
- [User Flow Diagram](#user-flow-diagram)
- [Pocket Feature Breakdown](#pocket-feature-breakdown)
- [Roles & Permissions System](#roles--permissions-system)
- [Project Structure](#project-structure)
- [Available Artisan Commands](#available-artisan-commands)
- [Troubleshooting](#troubleshooting)

---

## About the Project

**Pocket** is a personal pocket/balance management system. Each registered user can:

- Record **income** and **expense** entries by date
- View **this week**, **this month**, and **year-by-year** financial summaries
- Track a running **balance** (carries forward from previous periods)
- Use a built-in **calculator**
- Manage their own **profile and photo**

Administrators can manage users, roles, permissions, entry types, languages, countries, cities, menus, and system configuration — all through a clean Admin panel backed by **Spatie Laravel Permission**.

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | PHP 7.3+ / 8.0+, Laravel 8.x |
| Frontend | TailwindCSS 3, AlpineJS 3, AdminLTE |
| Build Tools | Laravel Mix (Webpack 6), PostCSS, Autoprefixer |
| Database | MySQL 8.0 |
| Auth | Laravel Breeze + Sanctum |
| Permissions | Spatie Laravel Permission |
| Modules | nwidart/laravel-modules |
| DataTables | yajra/laravel-datatables-oracle |
| Excel I/O | maatwebsite/excel |
| PDF | carlos-meneses/laravel-mpdf |
| Barcode/QR | milon/barcode + simplesoftwareio/simple-qrcode |
| HTTP Client | Guzzle 7 |

---

## Architecture Overview

```
┌─────────────────────────────────────────────────────┐
│                    HTTP Request                      │
└──────────────────────────┬──────────────────────────┘
                           │
              ┌────────────▼────────────┐
              │    Laravel HTTP Kernel   │
              │   (Middleware Stack)     │
              │  • SystemInformation     │
              │  • Language / Timezone   │
              │  • ChosenLanguage        │
              │  • CheckPermission       │
              └────────────┬────────────┘
                           │
         ┌─────────────────▼──────────────────┐
         │         Modular Router              │
         │   /pocket   /setups   /peoples      │
         │   /dashboard  (auth routes)         │
         └──────┬──────────┬──────────┬────────┘
                │          │          │
         ┌──────▼──┐  ┌────▼───┐  ┌──▼──────┐
         │ Pocket  │  │Setups  │  │Peoples  │
         │ Module  │  │Module  │  │ Module  │
         └──────┬──┘  └────────┘  └─────────┘
                │
     ┌──────────▼──────────┐
     │   Entry / EntryType  │
     │       Models         │
     └──────────┬───────────┘
                │
     ┌──────────▼───────────┐
     │      MySQL 8.0        │
     └───────────────────────┘
```

---

## Module Map

```
Modules/
├── Dashboard/     ← Landing dashboard after login (chart save, session clear)
├── Language/      ← Multi-language support (Language, LanguageLibrary entities)
├── Peoples/       ← User management with DataTables & role assignment
├── Pocket/        ← Core: income/expense entries, balance, calculator, profile
└── Setups/        ← System config: Roles, Permissions, EntryTypes,
                      Menus, Countries, Cities, Crons, SystemInformation
```

---

## Application Flow

```
┌──────────────────────────────────────────────────────────────────┐
│                        User Journey                               │
│                                                                  │
│  Visit /  ──► Redirect to /pocket                                │
│                    │                                             │
│              Not authenticated?                                  │
│                    │                                             │
│              ┌─────▼──────┐    ┌───────────────┐                │
│              │  Sign In   │    │   Sign Up      │                │
│              │ /sign-in   │    │  /sign-up      │                │
│              └─────┬──────┘    └───────┬───────┘                │
│                    │                   │                         │
│              ┌─────▼───────────────────▼──────┐                 │
│              │         /pocket (Dashboard)      │                │
│              │  ┌─────────────────────────┐    │                │
│              │  │  This Week Summary       │    │                │
│              │  │  This Month Summary      │    │                │
│              │  │  Yearly Summary (all yrs)│    │                │
│              │  └─────────────────────────┘    │                │
│              └────────────┬────────────────────┘                │
│                           │                                      │
│          ┌────────────────┼────────────────────┐                │
│          │                │                    │                 │
│    ┌─────▼──────┐  ┌──────▼──────┐  ┌──────────▼──────┐        │
│    │ Add Income │  │ Add Expense │  │   Calculator     │        │
│    │  Entry     │  │  Entry      │  │  /pocket/calc    │        │
│    └────────────┘  └─────────────┘  └─────────────────┘        │
│                                                                  │
│  Admin routes: /setups/**  /peoples/**  /dashboard/**            │
└──────────────────────────────────────────────────────────────────┘
```

---

## Prerequisites

Before you begin, make sure you have the following installed:

| Tool | Version | Check Command |
|------|---------|---------------|
| PHP | 7.3 or 8.0+ | `php -v` |
| Composer | 2.x | `composer -V` |
| Node.js | 14+ | `node -v` |
| npm | 6+ | `npm -v` |
| MySQL | 8.0 | `mysql --version` |
| Git | any | `git --version` |

> **Windows users:** Use [XAMPP](https://www.apachefriends.org/), [Laragon](https://laragon.org/), or [WSL2](https://learn.microsoft.com/en-us/windows/wsl/install) for the best experience.

---

## Installation

### Step 1 — Clone the Repository

```bash
git clone https://github.com/arafat-anwar/pocket.git
cd pocket
```

### Step 2 — Install PHP Dependencies

```bash
composer install
```

### Step 3 — Install Node Dependencies

```bash
npm install
```

### Step 4 — Copy the Environment File

```bash
cp .env.example .env
```

> **Windows:**
> ```powershell
> copy .env.example .env
> ```

### Step 5 — Generate Application Key

```bash
php artisan key:generate
```

---

## Configuration

Open `.env` and update the following values:

```dotenv
# Application
APP_NAME="Pocket"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pocket
DB_USERNAME=root
DB_PASSWORD=your_password

# Mail (optional — set mail_activated=false in config/app.php for local dev)
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# Timezone
APP_TIMEZONE=UTC
```

> **Tip:** For local development, mail is disabled by default (`'mail_activated' => false` in `config/app.php`). No mail config is required to run locally.

---

## Database Setup

### Step 1 — Create the Database

Log into MySQL and run:

```sql
CREATE DATABASE pocket CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 2 — Run Migrations

```bash
php artisan migrate
```

This creates all tables including:

| Table | Description |
|-------|-------------|
| `users` | Application users |
| `roles` / `permissions` | Spatie RBAC tables |
| `model_has_roles` | Links users → roles |
| `entries` | Income / Expense rows |
| `entry_types` | Income & Expense type definitions |
| `schedules` | Cron schedule records |
| `password_resets` | Password reset tokens |
| `personal_access_tokens` | Sanctum API tokens |

### Step 3 — Run Seeders

```bash
php artisan db:seed
```

> If no default seeder is configured, proceed to **First-Run Setup** below to create data manually.

---

## First-Run Seeding & Admin Setup

After migrations you need at least two roles and two entry types to use the application.

### Create Roles via Tinker

```bash
php artisan tinker
```

```php
// Create roles
Spatie\Permission\Models\Role::create(['name' => 'Admin', 'guard_name' => 'web']);
Spatie\Permission\Models\Role::create(['name' => 'User',  'guard_name' => 'web']);

// Create entry types (Income and Expense)
Modules\Pocket\Entities\EntryType::create([
    'name'     => 'Income',
    'sign'     => '+',
    'color'    => 'success',
    'positive' => 1,
    'icon'     => 'fas fa-arrow-up',
    'desc'     => 'Money coming in',
    'status'   => 1,
]);
Modules\Pocket\Entities\EntryType::create([
    'name'     => 'Expense',
    'sign'     => '-',
    'color'    => 'danger',
    'positive' => 0,
    'icon'     => 'fas fa-arrow-down',
    'desc'     => 'Money going out',
    'status'   => 1,
]);

// Create an admin user
$admin = App\Models\User::create([
    'name'     => 'Administrator',
    'username' => 'admin',
    'email'    => 'admin@example.com',
    'password' => bcrypt('password'),
    'status'   => 1,
]);
$admin->assignRole('Admin');

exit
```

---

## Running the Application

### Option A — Laravel Development Server

```bash
# Terminal 1: Start PHP server
php artisan serve

# Terminal 2: Compile frontend assets (watch mode)
npm run watch
```

Visit: **http://localhost:8000**

### Option B — Production Build

```bash
npm run production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Then point your web server (Nginx / Apache) at the `public/` folder.

### Option C — Reboot Helper (clears all caches)

Visit the following URL in a browser (development only):

```
http://localhost:8000/reboot
```

This clears cache, routes, views, regenerates app key, and re-caches config.

---

## Usage Guide

### 1. Sign Up as a New User

```
GET /sign-up
```

- Fill in Name, Username, Email, Gender, City, and Password
- After registration the account is assigned the **User** role automatically

### 2. Sign In

```
GET /sign-in
```

- Login with your **username or email** + password

### 3. Pocket Dashboard (`/pocket`)

After login you land on the Pocket dashboard which renders **three panels**:

| Panel | URL | Description |
|-------|-----|-------------|
| This Week | `/pocket` section | Day-by-day income vs expense for the current week |
| This Month | `/pocket` section | Day-by-day income vs expense for the current month |
| Yearly | `/pocket` section | Month-by-month breakdown for every year with entries |

### 4. Add an Income Entry

```
POST /pocket/saveIncomeEntry
```

Fields: `title`, `amount`, `date`

### 5. Add an Expense Entry

```
POST /pocket/saveExpensesEntry
```

Fields: `title`, `amount`, `date`

### 6. View / Filter Entries

```
GET /pocket/getEntryHead/{start_date}/{end_date}/{text}
GET /pocket/getEntryBody/{start_date}/{end_date}/{text}
```

### 7. Edit an Entry

```
GET  /pocket/entryEdit/{entry_id}
POST /pocket/entryEditSubmit/{entry_id}
```

### 8. Calculator

```
GET /pocket/calculator
```

### 9. Profile Management

| Action | URL |
|--------|-----|
| View/Edit Profile | `GET/POST /profile` |
| Update Photo | `GET/POST /update-photo` |
| Change Password | `GET/POST /update-password` |
| Activity Log | `GET /activities` |

### 10. Admin — Setup Panel (`/setups`)

| Feature | URL |
|---------|-----|
| System Information | `/setups/system-information` |
| Modules | `/setups/modules` |
| Menus & Submenus | `/setups/menu`, `/setups/submenu` |
| Roles | `/setups/roles` |
| Permissions | `/setups/permissions` |
| Role → Permission Map | `/setups/role-permissions` |
| Countries & Cities | `/setups/countries`, `/setups/cities` |
| Entry Types | `/setups/entry-types` |
| Languages | `/setups/switch-language` |
| Cron Jobs | `/setups/crons` |

### 11. Admin — User Management (`/peoples`)

```
GET  /peoples/users         # list all users (DataTables AJAX)
GET  /peoples/users/create  # new user form
POST /peoples/users         # save new user
GET  /peoples/users/{id}/edit
PUT  /peoples/users/{id}
DELETE /peoples/users/{id}
```

### 12. Change Language

```
GET /change-language/{code}   # e.g. /change-language/ar  (switches RTL/LTR)
```

---

## User Flow Diagram

```
┌───────────────────────────────────────────────────────────────────┐
│                        POCKET APP FLOW                             │
└───────────────────────────────────────────────────────────────────┘

 Browser ──► /
              │
              ▼
         ┌─────────────────┐
         │  Authenticated? │
         └────┬──────┬─────┘
              │ No   │ Yes
              ▼      ▼
        ┌──────────┐  ┌────────────────────────────────────┐
        │ /sign-in │  │           /pocket                   │
        │ /sign-up │  │  ┌──────────────────────────────┐  │
        └────┬─────┘  │  │  THIS WEEK (Mon → Today)      │  │
             │        │  │  Income ↑  |  Expense ↓       │  │
             │        │  │  Balance = Prev + Inc - Exp   │  │
             │        │  └──────────────────────────────┘  │
             ▼        │  ┌──────────────────────────────┐  │
        ┌──────────┐  │  │  THIS MONTH (1st → Today)    │  │
        │  Login   │  │  │  Income ↑  |  Expense ↓      │  │
        │  Check   │  │  └──────────────────────────────┘  │
        │ Role =   │  │  ┌──────────────────────────────┐  │
        │ "User"   │  │  │  YEARLY (Jan → Current Month)│  │
        └────┬─────┘  │  │  Per-year accordion panels   │  │
             │        │  └──────────────────────────────┘  │
             ▼        └──────────────┬─────────────────────┘
        Redirect /                   │
                         ┌───────────┼────────────────┐
                         │           │                │
                    ┌────▼────┐  ┌───▼────┐  ┌───────▼──────┐
                    │+ Income │  │-Expense│  │  Profile /    │
                    │ Entry   │  │ Entry  │  │  Calculator   │
                    └─────────┘  └────────┘  └──────────────┘


 Admin Flow:
 ┌────────────────────────────────────────────────────────────┐
 │  Login with Admin role                                      │
 │       │                                                     │
 │       ├──► /setups/roles          Create / Edit Roles       │
 │       ├──► /setups/permissions    Create Permissions         │
 │       ├──► /setups/role-permissions  Assign Perms → Roles   │
 │       ├──► /setups/entry-types    Income / Expense types     │
 │       ├──► /setups/countries      Manage Countries           │
 │       ├──► /setups/cities         Manage Cities              │
 │       ├──► /peoples/users         Manage Users               │
 │       └──► /setups/switch-language  Multi-lang Setup         │
 └────────────────────────────────────────────────────────────┘
```

---

## Pocket Feature Breakdown

```
Pocket Module
│
├── Entry Types (managed in Setups)
│     ├── ID 1 → Income   (positive, green)
│     └── ID 2 → Expense  (negative, red)
│
├── Entry Model (entries table)
│     ├── user_id       → belongs to User
│     ├── entry_type_id → belongs to EntryType
│     ├── title
│     ├── amount
│     ├── date
│     └── status
│
├── Balance Calculation
│     previousPocket(date) + Σ Income − Σ Expense = Current Balance
│
├── Period Views
│     ├── thisWeek()   → Mon–Today, day by day
│     ├── thisMonth()  → 1st–Today, day by day
│     └── yearly()     → Jan–Current Month, month by month
│           └── year($year) → full month breakdown per year
│
└── CRUD
      ├── saveIncomeEntry
      ├── saveExpensesEntry
      ├── entryEdit / entryEditSubmit
      ├── entryHead (header info for date range)
      ├── entryBody (entries list for date range)
      └── latestPocket (most recent balance)
```

---

## Roles & Permissions System

Built on **Spatie Laravel Permission**.

```
Role: Admin
  └── Has all permissions (setups, peoples, dashboard)
  └── Accesses: /setups/**, /peoples/**, /dashboard/**

Role: User
  └── Accesses: /pocket/**, /profile, /activities
  └── Sees only their own entries
  └── Cannot access admin panels
```

Custom middleware:

| Middleware | Alias | Purpose |
|-----------|-------|---------|
| `CheckPermission` | `check_permission` | RBAC gate for resource controllers |
| `User` | `user` | Ensures current user has "User" role |
| `Unauthenticated` | `unauthenticated` | Redirects logged-in users away from auth pages |
| `Language` | *(global)* | Loads system/default language |
| `ChosenLanguage` | *(global)* | Applies session-stored language preference |
| `SystemInformation` | *(global)* | Shares system info to all views |
| `Timezone` | *(global)* | Sets PHP timezone from system config |

---

## Project Structure

```
pocket/
├── app/
│   ├── Helpers/
│   │   ├── Functions.php      # Date, age, email, ordinal utilities
│   │   ├── Helpers.php        # System info, column visibility, unique codes
│   │   ├── HeaderColumns.php  # DataTable column helpers
│   │   ├── Pocket.php         # Income/expense/balance calculation helpers
│   │   └── Storages.php       # File / image path helpers
│   ├── Http/
│   │   ├── Kernel.php         # Middleware registration
│   │   └── Middleware/        # Auth, permission, language middleware
│   ├── Models/
│   │   ├── User.php           # Authenticatable + HasRoles
│   │   └── Cron.php
│   └── Providers/
│
├── Modules/
│   ├── Dashboard/             # /dashboard route, chart image save
│   ├── Language/              # Language & LanguageLibrary entities
│   ├── Peoples/               # User CRUD (admin)
│   ├── Pocket/                # Core finance feature
│   │   ├── Entities/          # Entry, EntryType models
│   │   ├── Http/Controllers/  # AuthController, PocketController, ProfileController
│   │   ├── Routes/web.php     # All Pocket routes
│   │   └── Database/Migrations/
│   └── Setups/                # Roles, perms, countries, entry types, menus
│
├── config/                    # Laravel config files
├── database/migrations/       # Core migration files
├── resources/
│   ├── css/ js/               # Raw assets
│   └── views/                 # Blade layouts, auth, components
├── routes/
│   ├── web.php                # Reboot helper + auth include
│   └── auth.php
├── public/                    # Web root (compiled assets)
├── tailwind.config.js
├── webpack.mix.js
├── composer.json
└── package.json
```

---

## Available Artisan Commands

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches (production)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate

# Rollback last migration batch
php artisan migrate:rollback

# Fresh migration + seed
php artisan migrate:fresh --seed

# Open interactive shell
php artisan tinker

# List all routes
php artisan route:list

# Module commands (nwidart)
php artisan module:list
php artisan module:enable  Pocket
php artisan module:disable Pocket
```

---

## Troubleshooting

| Problem | Solution |
|---------|----------|
| **Blank page / 500 error** | Run `php artisan config:clear` and check `storage/logs/laravel.log` |
| **Class not found** | Run `composer dump-autoload` |
| **Assets not loading** | Run `npm run dev` or `npm run production` |
| **Route not found** | Run `php artisan route:clear` then `php artisan route:cache` |
| **Permission denied (storage/)** | Run `chmod -R 775 storage bootstrap/cache` (Linux/Mac) |
| **"No User account Found"** | Make sure the user has the **User** role assigned via tinker or admin panel |
| **Login redirects back to sign-in** | Check that role "User" exists and is assigned to the account |
| **Language not switching** | Clear session and check that the language code exists in the `languages` table |
| **SQLSTATE key too long** | Add `Schema::defaultStringLength(191)` in `AppServiceProvider::boot()` |

---

## License

This project is open-sourced under the [MIT License](LICENSE).

---

<div align="center">
Built with ❤️ using <a href="https://laravel.com">Laravel</a>
</div>
