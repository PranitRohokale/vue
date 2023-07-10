<?php
use App\Models\Todo;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('show');
});


Route::prefix('todos')->group(function () {
    Route::get('/', function(){

    })->name('todos.index');

    Route::get('/create', [TodoController::class, 'create'])->name('todos.create');
    Route::post('/', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/{id}', [TodoController::class, 'show'])->name('todos.show');
    Route::get('/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
    Route::put('/{id}', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
});

