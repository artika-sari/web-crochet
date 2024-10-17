    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CrochetController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('home');
})-> name('home');

//Data Crochet
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/crochets', [CrochetController::class, 'index'])->name('crochets');
Route::get('/crochets/add', [CrochetController::class, 'create'])->name('crochets.add');
Route::post('/crochets/add', [CrochetController::class, 'store'])->name('crochets.add.store');
Route::delete('/crochets/delete/{id}', [CrochetController::class, 'destroy'])->name('crochets.delete');
Route::get('/crochets/edit/{id}', [CrochetController::class, 'edit'])->name('crochets.edit');
Route::patch('/crochets/edit/{id}', [CrochetController::class, 'update'])->name('crochets.edit.update');

//Account
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/add', [UserController::class, 'create'])->name('users.add');
Route::post('/users/add', [UserController::class, 'store'])->name('users.add.store');
Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::patch('/users/edit/{id}', [UserController::class, 'update'])->name('users.edit.update');