"# laravel-vue-first-project" 
# Laravel-Vue Image Gallery

This project is a web application built with Laravel (backend) and Vue.js (frontend - assumed) that allows users to register, log in, upload, view, and delete images.

## Features

*   **User Authentication:**
    *   User registration
    *   User login
    *   User logout
    *   Password reset functionality
    *   Email verification
*   **Image Management:**
    *   Upload images with a label.
    *   View a gallery of uploaded images.
    *   Delete owned images.
*   **API:**
    *   Secure API endpoints for authenticated users.

## Technologies Used

*   **Backend:**
    *   PHP
    *   Laravel Framework
    *   Laravel Sanctum (for API authentication)
*   **Frontend (Assumed):**
    *   Vue.js
*   **Database:**
    *   (Specify your database, e.g., MySQL, PostgreSQL, SQLite)
*   **Storage:**
    *   Local filesystem (for image storage, configurable in Laravel)

## Prerequisites

*   PHP (version as per your `composer.json`, typically >= 8.1 for recent Laravel versions)
*   Composer
*   Node.js and npm (or yarn)
*   A web server (e.g., Nginx, Apache) or Laravel Valet/Sail
*   A database server (e.g., MySQL, PostgreSQL)

## Installation

1.  **Clone the repository:**
    ```bash
    git clone <your-repository-url>
    cd laravel-vue
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Install JavaScript dependencies:**
    ```bash
    npm install
    # or
    # yarn install
    ```

4.  **Set up your environment file:**
    *   Copy `.env.example` to `.env`:
        ```bash
        cp .env.example .env
        ```
    *   Generate an application key:
        ```bash
        php artisan key:generate
        ```
    *   Configure your database connection details in `.env` (DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
    *   Configure your application URL (`APP_URL`) and frontend URL (`SANCTUM_STATEFUL_DOMAINS` or `SESSION_DOMAIN` if applicable for Sanctum SPA authentication) in `.env`.

5.  **Run database migrations:**
    ```bash
    php artisan migrate
    ```

6.  **Link storage (for public access to uploaded files):**
    ```bash
    php artisan storage:link
    ```

7.  **Compile frontend assets:**
    ```bash
    npm run dev
    # or for production
    # npm run build
    ```

8.  **Serve the application:**
    *   Using Laravel's built-in server (for development):
        ```bash
        php artisan serve
        ```
    *   Or configure a virtual host with your web server (e.g., Nginx, Apache).

## API Endpoints

All API endpoints are prefixed with `/api`. Authenticated endpoints require a Sanctum token.

### Authentication Routes (`routes/auth.php`)

*   `POST /register`: Register a new user.
*   `POST /login`: Log in an existing user.
*   `POST /logout`: Log out the authenticated user (requires authentication).
*   `POST /forgot-password`: Request a password reset link.
*   `POST /reset-password`: Reset password using a token.
*   `GET /verify-email/{id}/{hash}`: Verify user's email address (requires authentication, signed URL).
*   `POST /email/verification-notification`: Resend email verification notification (requires authentication).

### Image Routes (`routes/api.php`)

These routes require authentication via Sanctum.

*   `GET /user`: Get the authenticated user's details.
*   `GET /images`: List all images.
*   `POST /images`: Upload a new image.
    *   **Body (form-data):**
        *   `label` (string, required, max:255): The label for the image.
        *   `path` (file, required, image, mimes:jpeg,png,jpg,gif,svg, max:2048KB): The image file.
*   `DELETE /images/{image}`: Delete an image (user can only delete their own images).

## Usage

1.  Navigate to the application URL in your browser.
2.  Register a new account or log in with existing credentials.
3.  Once logged in, you can access the image gallery.
4.  Upload new images using the provided form.
5.  Delete images you have uploaded.

## Contributing
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

