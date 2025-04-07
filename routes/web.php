<?php

use App\Livewire\ContactList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ConfirmPasswordController;

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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/confirm-password', [ConfirmPasswordController::class, 'store'])
    ->middleware(['auth'])
    ->name('password.confirm');

require __DIR__.'/auth.php';
