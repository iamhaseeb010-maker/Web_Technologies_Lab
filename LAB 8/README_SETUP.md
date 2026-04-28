Setup instructions for the Lab8 copy

Run these commands from a terminal in the project root (`c:\laragon\www\LAB 8\lab7`).

PowerShell example:

```powershell
composer install
php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=LinksTableSeeder
php artisan storage:link
```

Notes:
- This repository copy is prepared to create a `links` table (migration added) and seed it.
- PHP and Composer must be available in your PATH (Laragon usually provides them).
