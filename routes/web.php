<?php

use App\Http\Controllers\ProgramController;
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
    return redirect()->route('programs.index');
});
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/create', [ProgramController::class, 'create'])->name('programs.create');
Route::get('/programs/{program}', [ProgramController::class, 'show'])->name('programs.show');
Route::get('/programs/{program}/edit', [ProgramController::class, 'edit'])->name('programs.edit');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
