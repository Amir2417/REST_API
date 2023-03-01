<?php


use App\Http\Controllers\Backend\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;


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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $users= User::all();
        return view('backend.index',compact('users'));
    })->name('dashboard');
});
Route::get('/user_logout',[UserProfileController::class,'logout'])->name('user.logout');
Route::get('/user_profile',[UserProfileController::class,'user_profile'])->name('user.profile');
Route::get('/user_profile_edit',[UserProfileController::class,'user_profile_edit'])->name('user.profile.edit');
