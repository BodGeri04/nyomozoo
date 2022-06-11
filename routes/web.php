<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

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

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/website/home', [HomeController::class, 'Homesearch']);
Route::get('/', [HomeController::class, 'Homesearch']);
Route::get('/admin/new_password', [AdminController::class, 'newPassword']);
Route::post('/admin/new_password', [AdminController::class, 'newPasswordPost']);
Route::get('admin/home', [AdminController::class, 'adminhome']);
Route::resource('/website/advertisement', AdvertisementController::class)->name('', 'advertisement');
Route::get('/website/advertisement', [AdvertisementController::class, 'index']);
Auth::routes();
// Google URL
Route::prefix('google')->name('google.')->group(function () {
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});
Route::get('/complete-registration', [RegisterController::class, 'completeRegistration']);
Route::post('/2fa', function () {
    return redirect(URL()->previous());
})->name('2fa')->middleware('2fa');
Route::get('/re-authenticate', [HomeController::class, 'reauthenticate']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::resource('/admin/user', UserController::class);
Route::get('/website/hirdetesek', [HomeController::class, 'search']);
Route::get('/website/sajatHirdetesek', [HomeController::class, 'ownads']);
Route::get('website/felhasznModosit', [UserController::class, 'felhasznModosit'])->name('felhasznModosit');
Route::post('website/felhasznModosit', [UserController::class, 'felhasznModositPost']);
Route::get('website/hirdetesReszletei/{id}', [HomeController::class, 'hirdetesReszletei']);
Route::post('website/hirdetesReszletei/{id}', [HomeController::class, 'sendEmail']);
Route::get('website/rolunk', [HomeController::class, 'rolunk']);
Route::get('website/hasznalatiFeltetelek', [HomeController::class, 'hasznalatiFeltetelek']);
Route::get('/admin/user/status/{user_id}/{status_code}', [UserController::class, 'updateStatus'])->name('user.status.update');
Route::get('website/adatkezeles', [HomeController::class, 'adatkezeles']);
Route::get('/website/talaltHirdetesek', [HomeController::class, 'found']);
Route::get('hirdetesPDF/{id}', [AdvertisementController::class, 'openPDF']);
Route::get('/website/kapcsolat', [HomeController::class, 'kapcsolat']);
Route::post('/website/kapcsolat', [HomeController::class, 'kapcsolatEmail']);
Route::resource('/website/velemeny', FeedBackController::class);
Route::get('/website/velemeny', [FeedBackController::class, 'index']);
//Route::get('admin/maintenance', [HomeController::class, 'maintenance']);
Route::get('admin/emailSend', [AdminController::class, 'MailsendAdmin']);
Route::post('admin/emailSend', [AdminController::class, 'MailsendAdminPage']);
Route::get('admin/deletedAds', [AdminController::class, 'deletedAds']);
Route::get('/admin/restore/one/{id}', [AdminController::class, 'restore'])->name('ads.restore');
//Route::get('admin/getIps', [AdminController::class, 'getIps']);
Route::get('admin/deletedUsers', [AdminController::class, 'deletedUsers']);
Route::get('/admin/restore/user/{id}', [AdminController::class, 'restoreUser'])->name('user.restore');
//
Route::get('admin/maintenance', [AdminController::class,'maintenance']);
Route::get('shut/the/application/down', function() 
{
    touch(storage_path().'/framework/maintenance.php');
});
Route::get('bring/the/application/back/up', function() 
{
    @unlink(storage_path().'/framework/maintenance.php');
});
