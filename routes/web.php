<?php

use App\Livewire\ContactList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

// Rota pública para listagem usando Livewire
Route::get('/', ContactList::class);
Route::get('/contacts', ContactList::class)->name('contacts.index');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    Route::resource('contacts', ContactController::class)
        ->except(['index']);
});

require __DIR__.'/auth.php';
