<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});
Route::get('/logout',[AdminController::class, 'index'])->name('admin.logout');

//manage user
Route::prefix('users')->group(function () {

Route::get('/view',[UserController::class, 'index'])->name('user.view');
    Route::get('/add',[UserController::class, 'create'])->name('users.add');
    Route::post('/store',[UserController::class, 'store'])->name('users.store');
    Route::get('/edit/{id}',[UserController::class, 'edit'])->name('users.edit');
    Route::post('/update/{id}',[UserController::class, 'update'])->name('update.user');
    Route::get('/delete/{id}',[UserController::class, 'destroy'])->name('users.delete');
});
//end manage user

//User Profile and Change Password
 Route::prefix('profile')->group(function(){
Route::get('/view', [ProfileController::class, 'index'])->name('profile.view');
Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/store', [ProfileController::class, 'store'])->name('profile.store');
Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
});
//End User Profile and Change Password
