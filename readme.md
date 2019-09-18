# Laravel Blog

A simple laravel blog application with categories and tags.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
PHP version 5.6 or above
Apache Server
MySQL Server
Composer
```

### Installing

A step by step series of examples that tell you how to get a development env running

Step 1: Clone repo.

```
git clone [url]
```

Step 2: Install Dependencies

```
composer install
```

Step 3: Duplicate the .evn.example file to .env file.

```
cp .env.example .env
```

Step 4: Set the database credentials in the .env file.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=DATABASE_NAME
DB_USERNAME=root
DB_PASSWORD=
```

Step 5: Set the application key.

```
php artisan key:generate
```

Step 6: Migrate and seed the database

```
php artisan migrate --seed
```

## Built With

-   [Laravel](https://laravel.com/docs/5.8) - The php framework used
-	[Bootstrap](https://getbootstrap.com/) - The web framework used
-   [Composer](https://getcomposer.org/doc/) - Dependency Management


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

-   **Dev Marketer** - [jacurtis](https://github.com/jacurtis/)
