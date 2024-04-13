## Installation Guide

- clone this repo to your local machine and change directory in your terminal to project root.
- copy `.example.env` to `.env` file: `cp .example.env .env`
- create a new database and add the database credentials to your `.env` file
- fill `APP_URL`, (`GITHUB_CLIENT_ID`, `GITHUB_CLIENT_SECRET`)[optional] in the `.env` file. the default `GITHUB_CLIENT_ID` &  `GITHUB_CLIENT_SECRET` should work as I created them for testing
- run `composer install`
- run `npm install && npm run build`
- run `php artisan key:generate`
- run `php artisan migrate`
- run `php artisan storage:link`

- fill the pusher environments after creating a new application and getting the necessary variables from pusher in the `.env` file 
