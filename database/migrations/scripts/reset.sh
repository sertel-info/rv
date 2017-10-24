#/bin/bash
php ../../../artisan migrate:reset --path=database/migrations/update*;
php ../../../artisan migrate:reset;
php ../../../artisan migrate;
php ../../../artisan migrate --path=database/migrations/update*;
