<?php

use App\Http\Controllers\ContactsController;
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
    return view('welcome');
});


Route::prefix('contacts')->group(function() {
    Route::get('/', [ContactsController::class, 'index'])->name('contacts.index');
    Route::get('/create', [ContactsController::class, 'create'])->name('contacts.create');
    Route::post('/store', [ContactsController::class, 'store'])->name('contacts.store');
    Route::get('/edit/{id}', [ContactsController::class, 'show'])->name('contacts.edit');
    Route::patch('/update/{id}', [ContactsController::class, 'update'])->name('contacts.update');
    Route::delete('/delete/{id}', [ContactsController::class, 'destroy'])->name('contacts.delete');
});