<?php

use App\Http\Controllers\PostController;
use App\Mail\WatchlistNotifier;
use Illuminate\Http\Request;
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

Route::post('/send/email', function (Request $request) {
    $request = $request->validate([
        'email' => 'required',
        'message' => 'required',
        'subject' => 'required',
    ]);
    $current_user_email = @auth()->user()->email;
    Illuminate\Support\Facades\Mail::send(new WatchlistNotifier($request, $current_user_email));
    return redirect('index');
});

Route::get('/', function () {
    return view('index');
});
// Route::get('/docs', function () {
//     return view('vendor.l5-swagger.index');
// });