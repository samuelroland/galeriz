# Pré-TPI Samuel Roland

## Prerequisites
### Skills
You need to know how to develop with Laravel and Livewire, AlpineJS and TailwindCSS. The first 2 are the most important, you can learn the following ones on the go.

## Setup

### Environment setup
You need:
<!-- check php and mysql versions choices -->
- PHP v8+
- MySQL v8+


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
