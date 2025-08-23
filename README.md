# Laravel & Redis E-commerce Project

This is a modern e-commerce web application built with Laravel 11 and powered by Redis. The project serves as a practical learning exercise to demonstrate core e-commerce functionalities and the effective use of Redis for high-performance features.

## Project Status: Core Transaction Flow Complete

The application now has a complete, end-to-end transaction flow. A user can browse products, add them to a cart, and successfully complete a purchase with a real payment.

### Completed Features (✅)
*   **Product Catalog:** Users can browse a grid of products and view individual product detail pages.
*   **User Authentication:** A complete, custom-built authentication system allows users to register, log in, and log out.
*   **Redis-Powered Shopping Cart:** A high-performance cart using Redis Hashes that persists for logged-in users and merges guest carts on login.
*   **Multi-Step Checkout Process:**
    *   Users can enter and save a shipping address.
    *   The system validates address information before proceeding.
*   **Stripe Payment Integration:** Securely process credit card payments using Stripe.js and the Stripe API. The application never directly handles sensitive card information.
*   **Order Management System:** Upon successful payment, a permanent record of the sale (including order details and items purchased) is created in the main SQL database. The user's cart is then automatically cleared.
*   **Database Transactions:** The order creation process is wrapped in a database transaction to ensure data integrity, preventing payment from being taken without a corresponding order record.

### Next Steps (🚀)
The foundational engine is built. The next phase focuses on enhancing the user experience and adding essential management features.

1.  **Build "My Orders" Page:** Allow users to view their complete order history.
2.  **Admin Dashboard:** Create a backend panel for managing products, viewing all orders, and overseeing users.
3.  **Enhance UX:** Implement features like product search, customer reviews, and wishlists.
4.  **Refine UI:** Improve the UI for the checkout and payment pages and implement consistent "flash" notifications for user actions.

## Tech Stack
*   **Backend:** Laravel 11 (PHP)
*   **Database:** MySQL (for permanent data like users, products, orders)
*   **In-Memory Store:** Redis (for caching, shopping carts, and session management)
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

