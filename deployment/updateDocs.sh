cd /var/www/domains/sleepingowladmin.ru
git submodule update --remote resources/docs
php artisan cache:clear
php artisan docs:clear-cache
php artisan docs:index