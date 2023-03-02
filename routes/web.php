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
        $log_user = Auth::user();
        return view('backend.index',compact('users','log_user'));
    })->name('dashboard');
});
Route::prefix('user')->group(function(){
    Route::get('/logout',[UserProfileController::class,'logout'])->name('user.logout');
    Route::get('/profile',[UserProfileController::class,'user_profile'])->name('user.profile');
    Route::get('/profile_edit',[UserProfileController::class,'user_profile_edit'])->name('user.profile.edit');
    Route::post('/profile_update',[UserProfileController::class,'update'])->name('user.profile.update');
});
