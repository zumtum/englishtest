## Setting up DEV environment

- `$ cp .env.example .env` - *build a local config and edit if it's necessary*
- `$ docker-compose up --build`
- `$ ./scripts/execute.sh php artisan migrate` - apply migrations
- `$ ./sctipts/execute.sh php artisan db:seed` - apply seeders
- `$ /sctipts/execute.sh php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"` - publish the JWT config
- `$ /sctipts/execute.sh php artisan jwt:secret` - create secret key
