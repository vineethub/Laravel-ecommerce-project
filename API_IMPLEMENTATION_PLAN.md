# Laravel E-commerce API Implementation Plan

## Project Overview
This document defines the functional and technical requirements for the Laravel e-commerce API backend, and it provides a task-driven execution plan for building the API layer required by the Nuxt frontend.

## Requirements

### Functional Requirements
- Authentication API with registration, login, logout, password reset, email verification, and user profile.
- Role-based access control for admin and customer features.
- Cart management API supporting guest and authenticated carts.
- Checkout API supporting guest checkout and authenticated checkout.
- Address management API for shipping addresses.
- Order processing API with order creation, order history, and order detail retrieval.
- Product browsing API with category and review support.
- Inventory management using stock quantity.
- Payment integration using Stripe PaymentIntent.
- Review submission API with admin approval.
- Coupon application API.
- API versioning (`/api/v1/`).

### Technical Requirements
- Laravel 10+ with Sanctum for API authentication.
- Redis for cart storage.
- Stripe PaymentIntent integration.
- Spatie Laravel-Permission for roles and permissions.
- API Resource classes for consistent JSON output.
- Validation and error handling for all input.
- Database migrations for inventory, payment, and guest checkout support.
- CORS configured for Nuxt frontend consumption.

## Tasks

### Phase 1: Authentication
- Add register, login, logout, password reset endpoints.
- Add email verification endpoint.
- Add `/me` endpoint for authenticated user details.
- Enable cart merge on login for guest carts.

### Phase 2: Cart API
- Build cart endpoints for add, update, remove, view, and clear.
- Support guest carts through cart identifiers.
- Persist cart contents in Redis.

### Phase 3: Checkout and Guest Support
- Add checkout endpoint to create orders.
- Add guest checkout support with customer name/email.
- Add address creation as part of checkout.
- Validate cart contents and stock availability.
- Create orders and order items from cart contents.
- Decrement product inventory on order placement.
- Use Stripe PaymentIntent to process payments.

### Phase 4: Order and Address APIs
- Add order history and order detail endpoints for users.
- Add address CRUD endpoints for logged-in users.
- Ensure orders contain payment and shipping metadata.

### Phase 5: Product and Resources
- Expose product listing and details as API endpoints.
- Add API resource transformers for products, orders, and addresses.
- Add product search and filter support.

### Phase 6: Infrastructure and Stabilization
- Add API versioning and route grouping.
- Add rate limiting to sensitive endpoints.
- Add robust validation and descriptive error responses.
- Add resource files for consistent JSON payloads.
- Add project documentation for future automation.

## Execution Plan

### Step 1: Database Updates
- Add `stock_quantity` to products.
- Add payment fields to orders: `payment_status`, `currency`, `payment_provider`, `provider_payment_id`, `tracking_number`, `customer_name`, `customer_email`.
- Make `user_id` nullable on orders and addresses for guest checkout.

### Step 2: Route Setup
- Use `/api/v1/` prefix.
- Define public product and cart routes.
- Define auth-protected address and order routes.
- Define checkout route accessible to guests and logged-in users.

### Step 3: Controller Implementation
- Build API controllers under `app/Http/Controllers/Api/`.
- Implement auth, cart, checkout, order, and address controllers.
- Support guest cart identifier handling.

### Step 4: Resource Serialization
- Create API resource classes for products, orders, order items, and addresses.
- Use resource classes for consistent JSON output.

### Step 5: Testing and Validation
- Validate endpoint syntax and route definitions.
- Run migrations for schema changes.
- Test auth flows, cart flows, checkout flows, and order retrieval.

## Current Progress
- Added API auth, cart, checkout, order, and address endpoints.
- Added API resource classes.
- Added migration for inventory and order guest support.
- Confirmed new API routes are registered and syntax checks pass.
- Applied migration successfully.

## Notes
- Stripe secret key must be configured in `.env` as `STRIPE_SECRET`.
- Guest checkout requires a cart identifier in `cart_id` or `X-Cart-ID` header.
- Product browsing endpoints are public for frontend access.
- Orders and addresses remain authenticated resources.
