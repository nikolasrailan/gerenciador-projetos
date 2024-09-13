<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\TarefaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// web.php

Route::get('/dashboard', [ProjetoController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projetos', ProjetoController::class);
    Route::resource('tarefas', TarefaController::class);
    
    Route::get('/tarefas/create/{projeto_id}', [TarefaController::class, 'create'])->name('tarefas.create');
    Route::get('/tarefas/{projeto_id}', [TarefaController::class, 'index'])->name('tarefas.index');

    
    

});

require __DIR__.'/auth.php';
