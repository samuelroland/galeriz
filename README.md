# Pré-TPI Samuel Roland
**PHPUnit tests:**  
[![PHPUnit tests](https://github.com/samuelroland/galeriz/actions/workflows/laravel.yml/badge.svg?branch=main)](https://github.com/samuelroland/galeriz/actions/workflows/laravel.yml)


![logo visual](/docs/img/logo-visual.png)

## Documentations
- **[Project documentation](/docs/docs.md)**
- **[Work Diary for every day of work](/docs/WorkDiary.md)**


## Prerequisites
### Skills
You need to know how to develop with Laravel and Livewire, AlpineJS and TailwindCSS. The first 2 are the most important, you can learn the following ones on the go.

### Tools
You need:
<!-- check php and mysql versions choices -->
- PHP v8+
- MySQL v8+
- Git v2+
- An IDE for PHP

## Setup

### Environment setup

Configure your `php.ini` file to enable the following extensions:
- SQLITE
- PDO MySQL
- Openssl
- Curl

### Project setup
1. Clone the repository and go inside:
    ```bash
    git clone https://github.com/samuelroland/galeriz.git
    cd galeriz
    ```
1. Install composer and node packages
    ```bash
    composer install
    npm install
    ```

1. Copy environment file and generate the app key 
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Create a database called `galeriz` in your MySQL server, and fill the DB_USERNAME and DB_PASSWORD constants in `.env`.

1. Create the symbolic link for the public storage
    ```bash
    php artisan storage:link
    ```

1. Create the database tables
    ```bash
    php artisan migrate
    ```

1. If you want to develop Galeriz, you can seed the database with testing data
    ```bash
    php artisan db:seed
    ```

1. Later, if you want to migrate and seed the database
    ```bash
    php artisan migrate:fresh --seed
    ```

### Run development server

1. You need to compile assets (CSS mostly) with mix with watch mode:
    ```bash
    npm run watch
    ```
    This uses Laravel Mix under the hood.

1. And in another, start the PHP server:
    ```bash
    php artisan server
    ```
1. You can now open your browser at `localhost:8000` or the displayed adress, and you can login with `sam@sam.com` - `password` or you can create a new account. 

### Prepare for production

1. You need to compile assets (CSS mostly)
    ```bash
    npm run prod
    ```
1. You can now start an Apache or Nginx server on the public folder to serve your app to the world.
