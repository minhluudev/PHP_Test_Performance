<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('benchmark', function () {
    $start = microtime(true);

    // Ví dụ chạy 10000 vòng xử lý tính toán
    $sum = 0;
    for ($i = 0; $i < 10000; $i++) {
        $sum += sqrt($i * 1234);
    }

    $time = microtime(true) - $start;

    return response()->json([
        'result' => $sum,
        'time_seconds' => $time,
    ]);
});

Route::get('/db-benchmark', function () {
    $start = microtime(true);
    $posts = Post::with('category')
        ->where('title', 'like', '% %')
        // ->orderBy('title', 'asc')
        ->paginate(10);
    $time = microtime(true) - $start;

    return response()->json([
        'queries' => 100,
        'time_seconds' => $time,
        'data' => $posts
    ]);
});

Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
