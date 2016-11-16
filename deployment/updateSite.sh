cd /var/www/domains/sleepingowladmin.ru
php artisan down
git pull
composer install
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan up