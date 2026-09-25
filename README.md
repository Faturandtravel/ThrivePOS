# ThrivePOS

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="280" alt="ThrivePOS Banner">
</p>

<p align="center">
  <strong>Modern, Fast, and Cloud-Connected Point of Sale (POS) & Store Management System</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS 4">
  <img src="https://img.shields.io/badge/Vite-7.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite 7">
  <img src="https://img.shields.io/badge/Firebase-Auth-FFCA28?style=for-the-badge&logo=firebase&logoColor=black" alt="Firebase Auth">
  <img src="https://img.shields.io/badge/Xendit-Payment_Gateway-0044B4?style=for-the-badge&logoColor=white" alt="Xendit Payment">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License MIT">
</p>

---

## Overview

**ThrivePOS** is a modern Point of Sale (POS) and retail management application designed for speed, simplicity, and flexibility. Built on **Laravel 12**, **Tailwind CSS v4**, and **Vite**, ThrivePOS delivers a seamless omnichannel checkout experience—supporting both traditional cash transactions and modern digital payments (QRIS, e-Wallets, Virtual Accounts) via **Xendit**, secured by **Firebase Google Authentication**.

---

## Key Features

### Cashier & Terminal POS

- **Interactive POS Interface**: Clean, responsive layout optimized for touchscreens, desktop, and tablets.
- **Real-Time Catalog Search & Filter**: Filter items by category or perform instant text searches.
- **Dynamic Cart Management**: Real-time quantity adjustments, price calculations, and subtotal/total summaries.
- **Multiple Payment Methods**:
    - **Cash**: Automated cash change computation with quick validation.
    - **Digital Payment (Xendit)**: Automatic invoice generation for QRIS, e-Wallets, and Virtual Accounts with real-time status polling.
- **Stock Guard**: Live inventory validation preventing orders beyond available stock with auto-decrement on order placement.
- **Thermal Receipt Printing**: Printable 80mm receipt modal with auto-format, store branding, and customizable footer notes.

### Dashboard & Business Analytics

- **Sales Metrics**: Track sales across Today, This Week, and This Month with period-over-period percentage growth indicators.
- **Visual Analytics (Chart.js)**:
    - Sales breakdown by product category.
    - Distribution breakdown by payment method.
- **Date Range Filters**: Filter sales reports and order history across customizable date ranges.
- **Excel Export**: Export complete transaction reports to `.xlsx` files using [Laravel Excel](https://laravel-excel.com/).

### Product & Category Management

- **Product Catalog (CRUD)**: Create, edit, and delete products with image upload, SKU/pricing, and inventory quantities.
- **Categorization**: Manage categories with safe deletion safeguards (prevents accidental deletion of categories containing active products).
- **Stock Tracking**: Visual cues for out-of-stock items with automatic cashier disabling.

### Transaction History

- Chronological list of orders with pagination.
- Filter transactions by date range.
- Detailed order inspection (items purchased, item prices, payment type, and payment status).
- Re-print receipts on demand for past transactions.

### Store & Receipt Customization

- Configure business details (Store Name, Phone, and Address).
- Upload store logo for branded thermal receipts.
- Customize receipt footer notes (e.g., return policies, thank you messages).

### Staff & Role-Based Access Control (RBAC)

- **Role Hierarchy**:
    - `super_admin`: Full access to dashboard, analytics, store settings, user management, and exports.
    - `kasir` (Cashier): Dedicated access to cashier terminal, orders, and products.
- **Staff Access Delegation**: Super Admins can invite and manage cashier accounts.
- **Self-Protection Safeguards**: Super Admin accounts and the active user cannot be self-demoted or deleted.

### Authentication & Security

- **Firebase Google Authentication**: Passwordless, fast sign-in with Google accounts.
- **Super Admin Auto-Provisioning**: Automatic setup for the configured primary admin email (`SUPER_ADMIN_EMAIL`).
- **Access Whitelist**: Non-whitelisted accounts are rejected automatically.
- **Secure Webhook Verification**: Dedicated endpoint for Xendit callbacks protected by header verification tokens (`x-callback-token`) with CSRF exclusion.

---

## Technology Stack

| Component              | Technology                                                                                                                                            |
| ---------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Backend Framework**  | [Laravel 12](https://laravel.com/)                                                                                                                    |
| **Language**           | [PHP 8.2+](https://www.php.net/)                                                                                                                      |
| **Frontend Styling**   | [Tailwind CSS v4](https://tailwindcss.com/) with `@tailwindcss/vite`                                                                                  |
| **Asset Bundler**      | [Vite 7](https://vitejs.dev/)                                                                                                                         |
| **Database**           | SQLite (default), MySQL, or PostgreSQL                                                                                                                |
| **Authentication**     | [Firebase Authentication](https://firebase.google.com/) via [`kreait/laravel-firebase`](https://github.com/kreait/laravel-firebase) & Firebase JS SDK |
| **Payment Gateway**    | [Xendit](https://www.xendit.co/) via [`xendit/xendit-php`](https://github.com/xendit/xendit-php)                                                      |
| **Reporting / Export** | [Laravel Excel (Maatwebsite)](https://laravel-excel.com/)                                                                                             |
| **Charts**             | [Chart.js](https://www.chartjs.org/)                                                                                                                  |

---

## Getting Started

### Prerequisites

Ensure you have the following installed on your machine:

- **PHP** >= 8.2 (with extensions: `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `json`, `mbstring`, `openssl`, `pdo_sqlite` or `pdo_mysql`, `tokenizer`, `xml`, `gd`)
- **Composer** >= 2.x
- **Node.js** >= 18.x & **npm**
- A **Firebase** project (for Google Sign-In)
- A **Xendit** account (Test or Production credentials)

---

### Installation Steps

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/ThrivePOS.git
    cd ThrivePOS
    ```

2. **Install PHP dependencies:**

    ```bash
    composer install
    ```

3. **Install JavaScript dependencies:**

    ```bash
    npm install
    ```

4. **Prepare the Environment File:**

    ```bash
    cp .env.example .env
    ```

5. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

6. **Create Public Storage Symlink:**

    ```bash
    php artisan storage:link
    ```

7. **Configure Database & Run Migrations:**

    If using SQLite (default):

    ```bash
    touch database/database.sqlite
    php artisan migrate
    ```

    _(Optional) If using MySQL, update `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in your `.env` file first._

---

## Environment Configuration

Open your `.env` file and configure the essential variables:

### 1. Super Admin Setting

Set the Google account email that will automatically receive `super_admin` privileges upon first login:

```env
SUPER_ADMIN_EMAIL=your-admin-email@gmail.com
```

### 2. Firebase Authentication Settings

- Download your **Firebase Service Account credentials JSON** from the Firebase Console (_Project Settings -> Service accounts -> Generate new private key_).
- Save the file inside your project (e.g. `storage/firebase/service-account.json`) and configure:

```env
FIREBASE_CREDENTIALS="storage/firebase/service-account.json"
```

- Provide your Firebase Web App credentials (from _Firebase Console -> Project Settings -> General -> Your apps_):

```env
VITE_FIREBASE_API_KEY=your_firebase_api_key
VITE_FIREBASE_AUTH_DOMAIN=your_project.firebaseapp.com
VITE_FIREBASE_PROJECT_ID=your_project_id
VITE_FIREBASE_STORAGE_BUCKET=your_project.firebasestorage.app
VITE_FIREBASE_MESSAGING_SENDER_ID=your_sender_id
VITE_FIREBASE_APP_ID=your_app_id
```

### 3. Xendit Payment Gateway

Get your secret API key and webhook verification token from the [Xendit Dashboard](https://dashboard.xendit.co/):

```env
XENDIT_SECRET_KEY=xnd_development_...
XENDIT_WEBHOOK_TOKEN=your_webhook_verification_token
```

> **Webhook URL**: In your Xendit Dashboard under _Settings -> Webhooks_, configure your Invoice callback URL to:  
> `https://your-domain.com/webhooks/xendit`

---

## Running Locally

### All-in-One Development Command

You can run the Laravel server, Vite hot-reload, queue worker, and logs concurrently:

```bash
composer run dev
```

Or run the services individually:

- **Laravel Backend Server:**
    ```bash
    php artisan serve
    ```
- **Vite Asset Compiler:**
    ```bash
    npm run dev
    ```
- **Background Queue Worker (optional):**
    ```bash
    php artisan queue:listen
    ```

Visit `http://127.0.0.1:8000` in your browser to access ThrivePOS.

---

## Project Architecture

```
ThrivePOS/
├── app/
│   ├── Exports/
│   │   └── OrdersExport.php          # Excel export generator
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php    # Firebase Google authentication
│   │   │   ├── PosController.php     # POS terminal, orders, dashboard, settings
│   │   │   ├── ProductController.php # Products & categories CRUD
│   │   │   └── XenditWebhookController.php # Xendit webhook callback handler
│   │   └── Middleware/
│   │       ├── RoleMiddleware.php    # RBAC role verification
│   │       └── TrackUserActivity.php # User activity tracker
│   └── Models/
│       ├── Category.php              # Product category model
│       ├── Order.php                 # Orders ledger
│       ├── OrderItem.php             # Line items per order
│       ├── Product.php               # Product items and inventory
│       ├── Setting.php               # Store settings and receipt info
│       └── User.php                  # User accounts and roles
├── database/
│   └── migrations/                   # Database schema definitions
├── resources/
│   ├── css/
│   │   └── app.css                   # Custom animations, scrollbar & Tailwind
│   ├── js/
│   │   └── app.js                    # Firebase Auth client & scripts
│   └── views/
│       ├── auth/
│       │   └── login.blade.php       # Google authentication screen
│       ├── components/
│       │   ├── navbar.blade.php      # Top navigation bar
│       │   ├── sidebar-left.blade.php# Main navigation sidebar
│       │   └── sidebar-right.blade.php# Interactive order cart sidebar
│       ├── layouts/
│       │   └── app.blade.php         # Master layout
│       └── pos/
│           ├── cashier.blade.php     # Cashier terminal interface
│           ├── dashboard.blade.php   # Analytics dashboard with charts
│           ├── product.blade.php     # Inventory and category manager
│           ├── receipt.blade.php     # Printable thermal receipt template
│           ├── setting.blade.php     # Store settings & staff management
│           ├── transactions.blade.php# Order logs & history
│           └── xendit-success.blade.php
├── routes/
│   └── web.php                       # Web & webhook routes
└── vite.config.js                    # Vite bundler configuration
```

---

## Security Best Practices

- **CSRF Protection**: All routes are protected by CSRF verification, with `/webhooks/xendit` securely excluded and validated through signature tokens (`x-callback-token`).
- **Database Safety**: Financial operations (`storeOrder`) utilize atomic database transactions (`DB::beginTransaction()` / `DB::rollBack()`) to guarantee data integrity across product inventory and orders.
- **RBAC**: Protected routes enforce `role:super_admin` middleware to prevent unauthorized administrative operations.
- **Sanitized Uploads**: Image uploads for product photos and store logos validate mime-types (`jpeg, png, jpg, gif, webp`) and maximum file size (2MB).

---

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork this repository.
2. Create a feature branch: `git checkout -b feature/amazing-feature`.
3. Commit your changes: `git commit -m 'Add some amazing feature'`.
4. Push to the branch: `git push origin feature/amazing-feature`.
5. Open a Pull Request.

---

## License

This project is open-sourced under the [MIT License](LICENSE).
