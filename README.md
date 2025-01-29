
## News Aggregator

This is an API that aggregates news from selected sources and keeps them up to date, providing access to front end devices to query articles bases on search, filter parameters and user preferences.

- clone the repository : git clone git@github.com:myrealjay/News-Agregator.git
- Run composer install
- Ensure you setup database in .env before running migrate
- Run php artisan migrate
- Run php artisan key:generate
- Run php artisan server
- Run php artisan schedule:work

The articles should be populated or updated every 1 hour. However you can populate instantly by runnning php artisan articles:fetch

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

