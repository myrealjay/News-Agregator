
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

###Using Docker
- Install start docker
- clone the repository : git clone git@github.com:myrealjay/News-Agregator.git
- Change database settings
- Run docker compose up --build -d

You are good to go

