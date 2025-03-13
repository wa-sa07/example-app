<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;

Route::get('/',  [EventController::class, 'index']); # mostra todos os registros

Route::get('/events/create',  [EventController::class, 'create'])->middleware('auth'); # mostra o formulário para criar um evento no banco
Route::get('/events/{id}',  [EventController::class, 'show']); #acessar uma nova rota no caso o show
Route::post('/events', [EventController::class, 'store' ]); # enviar os dados pro banco
# eu vou jogar toda a lógica de adição de dados na minha dentro desse método store que é o padrão do laravel
# aqui na minha view na minha action que eu quero atingir

#Route::get('/contact',  [EventController::class, 'contact']);


Route::get('/contact', function () {
    return view('contact');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
