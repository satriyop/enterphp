<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\PhpProcess;

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

Route::get('/editor', function() {
    return view('editor');
});

Route::post('/code', function () {
    $req = request()->all();
    // TEMP : executes a command in a sub-process
    $process = new PhpProcess($req["code"]);
    $exitCode = $process->run();
    $output = $process->getOutput();
    // save code to a file
    Storage::put('codes.php', $req["code"]);

    // evaluate file with php filename
    // initiate docker container
    // get return from docker container
    // save code to db
    // execute code in safe inv
    // respond to front end
    if (!$exitCode == 0) {
        return response()->json([
            "result" => $output
        ]);
    }
    
    return response()->json([
        "result" => $output
    ]);
    
    // delete file
    Storage::delete('codes.php');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

