### Myspace

A website where you can create and modify your own profile.

## Installation

Composer is necessary to install all the required packages: https://getcomposer.org

NPM (Node Package Manager) is also required: https://nodejs.org

To get started run the following commands in the terminal (command prompt) from the project folder:

```
composer install; npm install
```

Next step is to create a new `.env` file and paste the contents of `.env.example` inside of it.

Before saving the file make sure to specify the details of whichever database you plan to use.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=myspace
DB_USERNAME=root
DB_PASSWORD=root
```

Then enter the following command into the terminal:

```
php artisan key:generate
```

When you are sure you entered the correct database details, enter the following command into the terminal:

```
php artisan migrate
```

## Storage

To enable storage for images, enter the following command in the terminal:

```
php artisan storage:link
```

## Compiling resources

All resources can be found in: `myspace\resources`

To compile resources using Laravel Mix, run the following command in the project folder:

```
npm run dev
```

Laravel Mix documentation: https://laravel.com/docs/6.0/mix
