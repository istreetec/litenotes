### Authentication using Breeze

Get Breeze package
- $ sail composer require laravel/breeze --dev

Add Breeze's Authentication scaffolding
- $ sail artisan breeze:install


### Create a model, Create a corresponding migration

- $ sail artisan make:model Note --migration


### Run migrations

- $ sail artisan migrate
