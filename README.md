#LaravelVue

A Laravel and Vue.js project implementing CRUD operations, search functionality, pagination, and authentication.
Table of Contents

    Introduction
    Features
    Technologies
    Installation
    Configuration
    Usage
    Authentication
    Contributing
    License

Introduction

This project is a web application built with Laravel and Vue.js. It demonstrates the implementation of basic CRUD (Create, Read, Update, Delete) operations, search functionality, pagination, and user authentication.
Features

    CRUD Operations: Create, read, update, and delete records.
    Search Functionality: Search through records.
    Pagination: Paginate the list of records.
    Authentication: User registration, login, and logout.

Technologies

    Backend: Laravel (PHP framework)
    Frontend: Vue.js (JavaScript framework)
    Database: MySQL (or any other database supported by Laravel)

Installation
Prerequisites

    PHP >= 8
    Composer
    Node.js & npm
    MySQL

Steps

    Clone the repository:
    git clone https://github.com/your-username/your-repo.git
    cd your-repo

Install backend dependencies:
composer install

Install frontend dependencies:
npm install

Create a copy of .env file:

cp .env.example .env

Generate application key:
php artisan key:generate

Set up your database:
Update your .env file with your database information.

env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

Run database migrations:
php artisan migrate

Build the frontend assets:
npm run dev

Serve the application:
php artisan serve

Configuration
Backend Configuration

All backend configurations are managed in the .env file. Make sure to update this file with your database and other environment variables.

Frontend Configuration

Vue.js components and configuration can be found in the resources/js directory.
API endpoints and other configurations can be adjusted in the axios setup or in the Vue components.

Usage

Access the application:
Open your browser and go to http://127.0.0.1:8000.

CRUD Operations:
    Navigate to the relevant section to create, view, update, or delete records.

Search:
    Use the search bar to filter records based on your query.

Pagination:
    Navigate through paginated results using the pagination controls.

Authentication

Registration:
    Go to the registration page and fill out the form to create a new account. /register

Login:
    Use your credentials to log in to the application. /login

Logout:
    Click the logout button to end your session.

Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any bug fixes or enhancements.

    Fork the repository.
    Create a new branch (git checkout -b feature-branch).
    Commit your changes (git commit -am 'Add new feature').
    Push to the branch (git push origin feature-branch).
    Create a new Pull Request.

License

This project is licensed under the MIT License.
