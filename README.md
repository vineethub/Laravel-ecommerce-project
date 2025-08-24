# Laravel & Redis E-commerce Project

This is a modern e-commerce web application built with Laravel 11 and powered by Redis. The project serves as a practical learning exercise to demonstrate core e-commerce functionalities and best practices in a real-world application.

## Project Status: Core Functionality Complete

The application now has a complete, end-to-end transaction flow and a full suite of user account management features. The foundational engine of the e-commerce store is built and fully functional.

### Completed Features (✅)
*   **Full E-commerce Transaction Flow:**
    *   **Product Catalog:** Browse products and view details.
    *   **Redis-Powered Shopping Cart:** A high-performance cart that persists for logged-in users and merges guest carts on login.
    *   **Multi-Step Checkout:** Users can enter and save a shipping address.
    *   **Stripe Payment Integration:** Securely process credit card payments via the Stripe API.
    *   **Order Management System:** Upon successful payment, a permanent record of the sale is created in the main SQL database.
*   **Complete User Account Management:**
    *   **User Authentication:** Custom registration, login, and logout system.
    *   **User Dashboard:** A central hub for logged-in users showing account stats and quick links.
    *   **Order History:** A dedicated page where users can view their past orders and order details.
    *   **Account Settings:** Users can update their profile information (name, email).
    *   **Secure Password Updates:** Users can securely change their account password.

### Next Steps (🚀)
The next phase focuses on enhancing the product discovery and shopping experience.

1.  **Product Search:** Implement a search bar to allow users to find products quickly.
2.  **Product Categories:** Group products into categories to improve browsing.
3.  **Admin Panel:** Create a backend panel for managing products, viewing all orders, and overseeing users.
4.  **Customer Reviews:** Allow verified purchasers to leave product reviews and ratings.


## Tech Stack
*   **Backend:** Laravel 11 (PHP)
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
