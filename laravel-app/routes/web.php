<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});


Route::get('franken-test', function () {
    static $counter = 0;
    $counter++;

    return response()->json([
        'mode' => 'FrankenPHP test',
        'counter' => $counter,
        'time' => date('H:i:s'),
    ]);
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
    $result = Benchmark::measure(
        fn() => Post::with('category')
            ->where('title', 'like', '% %')
            // ->orderBy('title', 'asc')
            ->paginate(10)
    );

    $result = round($result / 1000, 2); // convert ms to s

    Log::info('[db-benchmark] Time: ' . $result . ' s');

    return response()->json([
        'result' => $result
    ]);
});

Route::resource('categories', CategoryController::class);
Route::resource('posts', PostController::class);
