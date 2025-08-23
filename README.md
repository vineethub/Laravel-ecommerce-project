# Laravel & Redis E-commerce Project

This is a modern e-commerce web application built with Laravel 11 and powered by Redis. The project serves as a practical learning exercise to demonstrate core e-commerce functionalities and the effective use of Redis for high-performance features like caching and session management.

## Project Status: In Development

The project is actively under development. The core foundation is complete, and we are currently building out the main e-commerce transaction features.

### Completed Features (✅)
*   **Product Catalog:** Users can browse a grid of products and view individual product detail pages.
*   **User Authentication:** A complete, custom-built authentication system allows users to register, log in, and log out. Routes are protected with middleware.
*   **Redis-Powered Shopping Cart:**
    *   A high-performance shopping cart using Redis Hashes.
    *   Supports both guest and authenticated user carts.
    *   Guest carts are seamlessly merged into user accounts upon login.
*   **Git Version Control:** The codebase is version-controlled and hosted on GitHub.

### Current Work-in-Progress (🚧)
*   **Checkout Flow:** Building the pages and logic for users to enter shipping information.

### Next Steps (🚀)
1.  **Payment Gateway Integration:** Integrate Stripe to handle secure online payments.
2.  **Order Management System:** Create a system to store permanent order records in the main SQL database.
3.  **User Dashboard:** Develop a dashboard for users to view their order history and manage their profiles.
4.  **Admin Panel:** Create a backend interface for store administrators to manage products and orders.

## Tech Stack
*   **Backend:** Laravel 11 (PHP)
*   **Database:** MySQL (for permanent data like users, products, orders)
*   **In-Memory Store:** Redis (for caching, shopping carts, and session management)
*   **Frontend:** Tailwind CSS

## Getting Started

Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
*   PHP (version 8.2 or higher)
*   Composer
*   Node.js & NPM
*   A local database server (e.g., MySQL)
*   Redis Server

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
    *   Set up your `DB_` connection details (database name, username, password).
    *   Ensure your `REDIS_HOST` and `REDIS_PORT` are correct.
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

