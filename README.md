# Emeline Numérique Blog

## Preparing the project for its first launch

```
composer install
npm install
```

## Launch the project locally

```
php -S localhost:8000 -t public
tailwind -i ./assets/css/main.css -o public/css/main.css --watch
```

## Compile CSS for production

```
tailwind -i ./assets/css/main.css -o public/css/main.css --minify
```

## Configure the mailer

Copy the `.env.example.php` file to `.env.local.php` then fill the MAILER_DSN variable with a compatible DSN with
Symfony Mailer.

## Configure the database connexion

Importe the database.sql file. The database engine I choose is MySQL (MariaDB). In `.env.local.php` fill in the variable values.
