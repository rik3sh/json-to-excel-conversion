## Installation Guide

- clone this repo to your local machine and change directory in your terminal to project root.
- run `composer install`
- run `npm install`
- copy `.example.env` to `.env` file: `cp .example.env .env`
- create a new database and add the database credentials to your `.env` file
- fill `APP_URL`, `GITHUB_CLIENT_ID`, `GITHUB_CLIENT_SECRET` in the `.env` file. you will need to create an OAuth App in your github (https://github.com/settings/developers) and fill the `Homepage URL` and `Authorization callback URL` according to your project url. the `Authorization callback URL` must have "http://ENTER_YOUR_PROJECT_URL/auth/callback" for the auth to work
- run `php artisan key:generate`
- run `php artisan migrate`
- run `php artisan storage:link`
- run `php artisan reverb:install`
- you can leave all the `REVERB` and `VITE` environments as it is except `REVERB_HOST`. change the `REVERB_HOST` to your domain for e.g. if you're using "http://127.0.0.1", `REVERB_HOST` should be `127.0.0.1`
- in a new terminal, run `php artisan reverb:start` to start the websocket and keep it running
- in another new terminal, run `php artisan queue:work` to start laravel queue workers and keep it running
- run `npm run build`. if needed, run `npm run dev`
- DONE