<?php

use App\Http\Controllers\ProfileController;
use App\Models\Message;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    //return redirect('/', [ 'messages' => Message::all()]);
    return view('messages.index', [ 'messages' => Message::all()]);
});

Route::resource('messages', MessageController::class)
    ->only(['index', 'store', 'destroy', 'edit', 'update', 'upVote', 'downVote']);

Route::post('/upVote/{id}', [MessageController::class, 'upVote'])->name('upVote');
Route::post('/down/{id}', [MessageController::class, 'downVote'])->name('downVote');

//Added by Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
