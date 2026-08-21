#!/bin/sh
set -e

echo "🚀 Starting ISMY Production Container..."

# Ensure storage directories exist and have proper permissions
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/storage/logs

chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Create storage link if not exists
php artisan storage:link || true

# Run database migrations and seeders automatically
echo "📦 Running database migrations..."
php artisan migrate --force --isolated || true

# Optimize cache
echo "⚡ Optimizing Laravel caches..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "🌐 Starting PHP-FPM and Nginx..."
php-fpm -D
nginx -g "daemon off;"
