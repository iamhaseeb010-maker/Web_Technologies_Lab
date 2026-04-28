<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return redirect()->route('articles.index');
});

Route::resource('articles', ArticleController::class);
use App\Http\Controllers\LinkController;
Route::resource('links', LinkController::class)->except(['show']);
// Quick test route: create an article and fire events (for verification)
Route::get('/_test_create', function () {
    $article = App\Models\Article::create([
        'title' => 'Test article ' . now()->timestamp,
        'body' => 'This is a test article created by _test_create route.'
    ]);

    return response('created: ' . $article->id, 201);
});

// Seed multiple test articles and return recent log lines for verification
Route::get('/_test_seed', function () {
    $created = [];
    for ($i = 1; $i <= 3; $i++) {
        $a = App\Models\Article::create([
            'title' => "Seed article {$i} " . now()->timestamp,
            'body' => "Seeded article {$i}"
        ]);
        $created[] = $a->id;
    }

    $logPath = storage_path('logs/laravel.log');
    $lines = [];
    if (file_exists($logPath)) {
        $lines = file($logPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
        $lines = array_slice($lines, -40);
    }

    return response()->json([
        'created_ids' => $created,
        'recent_log' => $lines,
    ]);
});
