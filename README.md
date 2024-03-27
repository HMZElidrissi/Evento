# Evento API

This is the backend for the Evento app. An event management system that manages events, users, and bookings.

## Technologies Used

- Laravel 10 (RESTful API)
- React + Vite
- Tailwind CSS
- PostgreSQL
- JWT Authentication [Firebase JWT](https://github.com/firebase/php-jwt)

## Getting Started

- Clone the repository

```bash
git clone https://github.com/HMZElidrissi/Evento-API.git
```

- Install dependencies

```bash
cd Evento-API
composer install
```

- Create a `.env` file and copy the contents of `.env.example` to it

```bash
cp .env.example .env
```

- Generate an application key

```bash
php artisan key:generate
```

- Run the migrations

```bash
php artisan migrate
```

- Start the development server

```bash
php artisan serve
```

## Frontend

> The Frontend is available at [Evento Frontend](https://github.com/HMZElidrissi/Evento-Frontend)
