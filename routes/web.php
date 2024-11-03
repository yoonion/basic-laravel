<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/articles/create', function () {
    return view('articles/create');
});

Route::post('/articles', function (Request $request) {
    // 비어있지 않고, 문자열이며, 255자를 넘지 않도록.
    $input = $request->validate([
        'text' => [
            'required',
            'string',
            'max:255'
        ],
    ]);

//    $host = config('database.connections.mysql.host');
//    $dbname = config('database.connections.mysql.database');
//    $username = config('database.connections.mysql.username');
//    $password = config('database.connections.mysql.password');
//
//    // pdo 객체를 만든다
//    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//
//    // 쿼리 준비
//    $stmt = $conn->prepare("INSERT INTO articles (text, user_id) VALUES (:body, :userId)");
//
//    // 쿼리 값 설정
//    $stmt->bindValue(':text', $input['text']);
//    $stmt->bindValue(':userId', Auth::id());
//
//    // 실행
//    $stmt->execute();

    DB::statement("INSERT INTO articles (text, user_id) VALUES (:body, :userId)", ['text' => $input['text'], 'userId' => Auth::id()]);

    return 'hello';
});
