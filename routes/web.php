<?php

use Illuminate\Support\Facades\Route;

use App\Models\Thought;
use App\Http\Controllers\ThoughtController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ThoughtLikesController;
use App\Models\User;
use App\Policies\UserPolicy;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
  Route::get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard', [
      'thoughts' => auth()->user()->thoughtList()->paginate(50)->toArray()['data'],
      'follows' => auth()->user()->follows()->get(),
      'links' => auth()->user()->getDashboardLinks(),
      'likeList' => auth()->user()->likeList()
    ]);
  })->name('dashboard');

  Route::get('/accounts/{user:username}', function (User $user) {
      return Inertia\Inertia::render('Account', [
        'thoughts' => $user->thoughts()->paginate(50)->toArray()['data'],
        'authUser' => auth()->user(),
        'follows' => auth()->user()->follows()->get(),
        'following' => auth()->user()->following($user),
        'user' => $user,
        'links' => $user->getAccountLinks(),
        'likeList' => auth()->user()->likeList()
      ]);
  })->name('account');

  Route::get('/explore', function () {
      return Inertia\Inertia::render('Explore', [
        'follows' => auth()->user()->follows()->get(),
        'users' => auth()->user()->getUsers(),
      ]);
  })->name('explore');

  Route::post('/accounts/{user:username}/follow', [FollowsController::class, 'store']);
});

Route::post('/thoughts', [ThoughtController::class, 'store']);
Route::post('/thoughts/{thought}/like', [ThoughtLikesController::class, 'store']);
Route::delete('/thoughts/{thought}/like', [ThoughtLikesController::class, 'destroy']);
