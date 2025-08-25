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
*   **Robust Authorization System:**
    *   Implemented a powerful roles and permissions system using `spatie/laravel-permission`.
    *   Created `Super-Admin`, `Admin`, and `Customer` roles.
*   **Functional Admin Panel:**
    *   A secure, role-protected admin area.
    *   Full CRUD (Create, Read, Update, Delete) functionality for managing **Product Categories**.
    *   Full CRUD functionality for managing **Products**, including assigning them to categories.

### Next Steps (🚀)
The core application and admin panel are functional. The next phase focuses on rounding out the admin experience and adding key customer-facing features.

1.  **Admin Order Management:** Build an interface for admins to view and manage customer orders.
2.  **Customer Reviews & Ratings:** Allow verified purchasers to leave product reviews.
3.  **Return/Refund System:** Implement a workflow for customers to request returns or refunds.
4.  **Coupon Code System:** Add functionality for creating and applying discount codes at checkout.
5.  **Build a RESTful API:** Create API endpoints for use with other applications (e.g., a mobile app).


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
