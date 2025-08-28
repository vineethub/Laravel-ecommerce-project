# Laravel & Redis E-commerce Project

This is a modern e-commerce web application built with Laravel 11 and powered by Redis. The project serves as a practical learning exercise to demonstrate core e-commerce functionalities and best practices in a real-world application.

## Project Status: Core Functionality Complete

The application now has a complete, end-to-end transaction flow and a full suite of user account management features. The foundational engine of the e-commerce store is built and fully functional.

### Completed Features (✅)
*   **Full E-commerce Transaction Flow:**
    *   Product Catalog, Redis-Powered Shopping Cart, Multi-Step Checkout, Stripe Payment Integration, and an Order Management System.
*   **Complete User Account Management:**
    *   User Authentication (Register, Login, Logout).
    *   User Dashboard, Order History, and full Account Settings.
*   **Functional Admin Panel:**
    *   A secure, role-protected admin area.
    *   Full CRUD for managing **Product Categories**, **Products**, and **Coupon Codes**.
    *   A complete **Order Management** system to view orders and update their status.
    *   An interface to manage customer **Return Requests**.
*   **Advanced Customer Features:**
    *   A complete **Shopping Cart** with add, view, update, and remove functionality.
    *   A **Customer Review & Rating** system for products.
    *   The ability for customers to **apply coupons** in the cart.
    *   A complete **Return/Refund System** allowing customers to request returns for completed orders.

### Next Steps (🚀)
The core application is now feature-complete. The final phase of development will focus on external integration.

1.  **Build a RESTful API:** Expose the application's data and functionality through a secure, token-based API using Laravel Sanctum. This will enable the development of other clients, such as:
    *   A native mobile application (iOS/Android).
    *   A headless frontend built with a framework like Next.js or Vue.js.


## Tech Stack
*   **Backend:** Laravel 12 (PHP)
*   **Authorization:** `spatie/laravel-permission`
*   **Database:** MySQL
*   **In-Memory Store:** Redis
*   **Frontend:** Tailwind CSS
*   **Payment Gateway:** Stripe


## Getting Started

Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
*   PHP (version 8.2 or higher)
*   Composer
*   Node.js & NPM
*   A local database server (e.g., MySQL)
*   Redis Server
*   A Stripe Developer Account

### Installation
1.  **Clone the repository:**
    ```
    git clone https://github.com/vineethub/Laravel-ecommerce-project.git
    cd Laravel-ecommerce-project
    ```

2.  **Install PHP dependencies:**
    ```
    composer install
    ```

3.  **Create your environment file:**
    ```
    cp .env.example .env
    ```

4.  **Configure your `.env` file:**
    *   Set up your `DB_` connection details.
    *   Ensure your `REDIS_` configuration is correct.
    *   Add your `STRIPE_KEY` and `STRIPE_SECRET` from your Stripe Dashboard.
    *   Set `CACHE_STORE=redis` and `REDIS_CLIENT=predis`.

5.  **Generate an application key:**
    ```
    php artisan key:generate
    ```

6.  **Run database migrations and seed with sample data:**
    ```
    php artisan migrate --seed
    ```

7.  **Install frontend dependencies:**
    ```
    npm install
    npm run dev
    ```

8.  **Run the development server:**
    ```
    php artisan serve
    ```
The application should now be running at `http://127.0.0.1:8000`.
