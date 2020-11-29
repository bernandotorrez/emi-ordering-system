<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Page\Home\HomeIndex;
use App\Http\Livewire\Page\About\AboutIndex;
use App\Http\Livewire\Page\Login\LoginIndex;
use App\Http\Livewire\Page\Register\RegisterIndex;
use App\Http\Livewire\Page\UserGroup\UserGroupIndex;
use App\Http\Livewire\Page\TestDetail\TestDetailIndex;
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

Route::get('/', function() {
    return redirect(route('login.index'));
});

Route::get('/login', LoginIndex::class)->middleware('guest')->name('login.index');
Route::get('/register', RegisterIndex::class)->name('register.index');
Route::get('/logout', function() {
    session()->forget(['user', 'level_access']);

    return redirect()->route('login.index');
})->name('logout');

Route::middleware('user.session')->group(function() {   
    Route::get('/home', HomeIndex::class)->name('home.index');
    Route::get('/about', AboutIndex::class)->name('about.index');

    //Route::get('/car-model', CarModelIndex::class)->name('car-model.index');
    
    Route::get('/test-detail', TestDetailIndex::class)->name('test-detail.index');

});

Route::middleware('admin.session')->prefix('admin')->group(function() {
    Route::get('/user-group', UserGroupIndex::class)->name('user-group.index');
});