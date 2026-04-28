# Lab6 - Articles (Laravel)

This project is a small Laravel app that demonstrates a simple Articles CRUD (create, read, update, delete).

What it contains
- Resource routes (redirects `/` → `/articles`): [routes/web.php](routes/web.php#L1-L20)
- Controller: `ArticleController` handles CRUD: [app/Http/Controllers/ArticleController.php](app/Http/Controllers/ArticleController.php#L1-L200)
- Model + migration for `articles` table: [app/Models/Article.php](app/Models/Article.php#L1-L120), [database/migrations/2026_04_22_000000_create_articles_table.php](database/migrations/2026_04_22_000000_create_articles_table.php#L1-L200)
- Blade views under [resources/views/articles](resources/views/articles/index.blade.php#L1-L200)
- A few demo articles were added to the seeder so the UI shows content after seeding: [database/seeders/DatabaseSeeder.php](database/seeders/DatabaseSeeder.php#L1-L200)

Quick run instructions (Windows / Laragon)
1. Open a terminal in the project root (C:\laragon\www\Lab6_new)

2. Verify prerequisites:
```powershell
php -v
composer -V
node -v
npm -v
```

3. Install PHP dependencies:
```powershell
composer install
```

4. Create `.env` and app key:
```powershell
copy .env.example .env
php artisan key:generate
```

5. Quick SQLite setup (recommended for graders):
```powershell
New-Item -Path database -ItemType Directory -Force
New-Item -Path database\database.sqlite -ItemType File -Force
```
- In `.env` ensure: `DB_CONNECTION=sqlite` and `DB_DATABASE=database/database.sqlite` (the project already ships `.env.example` configured for sqlite).

6. Run migrations and seed demo content:
```powershell
php artisan migrate --seed
```

7. Optional frontend (Vite):
```powershell
npm install
npm run dev
# or build for production: npm run build
```

8. Start dev server:
```powershell
php artisan serve --host=127.0.0.1 --port=8000
```
Open http://127.0.0.1:8000 — it redirects to `/articles`.

Notes for submission
- Do NOT include your real `.env` with secrets. Use `.env.example` as provided.
- The seeder adds three sample articles so an instructor can view content immediately after `migrate --seed`.
- For quick grading use SQLite; for production use a proper DB and update `.env`.

If you want, I can also:
- create a zip of the project for submission, or
- add a short `SUBMISSION.md` with grading instructions.
