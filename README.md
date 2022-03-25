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
- **TODO**

<!-- IDE ??-->
<!-- Extensions ??-->

## Setup

### Environment setup

Configure your `php.ini` file to enable the following extensions:
- **TODO**

### Project setup
1. Clone the repository and go inside:
    ```bash
    git clone https://github.com/samuelroland/pretpi.git
    cd pretpi
    ```

1. Copy environment file and generate the app key 
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

1. Install composer and node packages
    ```bash
    composer install
    npm install
    ```

### Run development server

1. You need to compile assets (CSS mostly) with mix with watch mode:
    ```bash
    npm run watch
    ```
    This uses Laravel Mix under the hood.

1. And start the PHP server:
    ```bash
    php artisan server
    ```
