<?php

use App\Livewire\ContactList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// Rota principal redireciona para contacts
Route::get('/', function () {
    return redirect()->route('contacts.index');
});

// Rota pública para listagem usando Livewire
Route::get('/contacts', ContactList::class)->name('contacts.index');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    Route::resource('contacts', ContactController::class)
        ->except(['index']);
});

require __DIR__.'/auth.php';
