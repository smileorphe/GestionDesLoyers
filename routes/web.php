<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LoyerController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\FactureController as UserFactureController;
use App\Http\Controllers\Admin\FactureController;

Route::get('/', function () {
    return view('welcome');
});

// Page d'accueil après connexion
Route::get('/welcome', [DashboardController::class, 'welcome'])
    ->middleware(['auth', 'verified'])
    ->name('welcome');

// Route pour la redirection vers le bon tableau de bord
Route::get('/dashboard/redirect', [DashboardController::class, 'redirectToDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.redirect');

Route::middleware(['auth', 'verified'])->group(function () {
    // Routes pour l'administrateur
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])
        ->name('dashboard');

    // Routes pour l'utilisateur normal
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])
        ->name('user.dashboard');
    Route::get('/user/messages', [MessageController::class, 'index'])->name('user.messages');
    Route::get('/user/messages/{message}', [MessageController::class, 'show'])->name('user.messages.show');
    Route::get('/user/factures', [UserFactureController::class, 'index'])->name('user.factures');
    Route::get('/user/factures/{id}', [UserFactureController::class, 'show'])->name('user.factures.show');
    Route::get('/user/factures/{id}/download', [UserFactureController::class, 'download'])->name('user.factures.download');

    // Admin Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Routes pour la messagerie
    Route::get('/messages', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [\App\Http\Controllers\Admin\MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages', [\App\Http\Controllers\Admin\MessageController::class, 'store'])->name('messages.store');
    Route::post('/messages/{message}/read', [\App\Http\Controllers\Admin\MessageController::class, 'markAsRead'])->name('messages.read');
    
    // Routes des ressources
    Route::resource('loyers', LoyerController::class);
    Route::resource('charges', ChargeController::class);
    Route::resource('transactions', TransactionController::class);
    
    // Routes pour les factures
    Route::resource('factures', FactureController::class);
    Route::post('factures/{facture}/send', [FactureController::class, 'send'])->name('factures.send');
});

require __DIR__.'/auth.php';
