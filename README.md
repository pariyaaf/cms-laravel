# CMS Laravel Project

## Introduction
This is a Content Management System (CMS) built with Laravel, designed for managing website content efficiently.

## Features
- User authentication (register, login, logout)
- Content creation and management
- Role-based access control
- Admin dashboard
- API support

## Installation
### Prerequisites
- PHP 8.x
- Composer
- MySQL or PostgreSQL

### Setup
1. Clone the repository:
   ```sh
   git clone https://github.com/pariyaaf/cms-laravel.git
   cd cms-laravel
   ```
2. Install dependencies:
   ```sh
   composer install
   ```
3. Copy environment file and configure it:
   ```sh
   cp .env.example .env
   ```
4. Generate application key:
   ```sh
   php artisan key:generate
   ```
5. Run migrations:
   ```sh
   php artisan migrate
   ```
6. Start the development server:
   ```sh
   php artisan serve
   ```

## Usage
- Access the application at `http://127.0.0.1:8000/`
- Log in as an admin to manage content

## License
This project is open-source and available under the MIT License.

