# Laravel 5.5.x Bootstrap 4 Preset

Bootstrap 4 scaffolding on new Laravel 5.5.x project.

*Now compatable with Bootstrap v4 beta 2.*

## Installation

You can install the package via composer:

`composer require appoly/laravel-bootstrap-4-preset`

You will then have the following commands available in your Laravel installation:

Basic scaffolding:

`php artisan preset bootstrap4`

Basic scaffolding and authorisation views:

`php artisan preset bootstrap4-auth`

*If you run the authorisation scaffolding command multiple times, duplicate entries in the routes files will appear*

Then install and run a build to compile the assets:

`npm install && npm run dev`
