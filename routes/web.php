<?php

use App\Http\Controllers\ProfileController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/**
 * 글 저장 page
 */
Route::get('/articles/create', function () {
    return view('articles/create');
});

/**
 * 글 저장
 */
Route::post('/articles', function (Request $request) {
    // 비어있지 않고, 문자열이며, 255자를 넘지 않도록.
    $input = $request->validate([
        'text' => [
            'required',
            'string',
            'max:255'
        ],
    ]);

    // Eloquent ORM 사용
    Article::create([
        'text' => $input['text'],
        'user_id' => Auth::id()
    ]);

    return 'hello';
});

/**
 * 글 목록 page
 */
Route::get('articles', function () {
    $articles = Article::all();
    return view('articles.index', ['articles' => $articles]);
});
