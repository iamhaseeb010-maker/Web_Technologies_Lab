# Setup script for Lab8 copy (run from project root)
Write-Host "Installing composer dependencies..."
composer install

Write-Host "Generating app key..."
php artisan key:generate

Write-Host "Running migrations..."
php artisan migrate --force

Write-Host "Seeding links..."
php artisan db:seed --class=LinksTableSeeder

Write-Host "Creating storage symlink..."
php artisan storage:link

Write-Host "Setup complete."
