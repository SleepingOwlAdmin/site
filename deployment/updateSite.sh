cd /var/www/domains/sleepingowladmin.ru
php artisan down
git pull
composer update
php artisan config:cache
php artisan route:cache
php artisan up