<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\UserSubmissionController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // Form routes
    Route::resource('forms', FormController::class);
    
    // Form fields routes
    Route::post('forms/{form}/fields', [FormFieldController::class, 'store'])->name('fields.store');
    Route::put('forms/{form}/fields/{field}', [FormFieldController::class, 'update'])->name('fields.update');
    Route::delete('forms/{form}/fields/{field}', [FormFieldController::class, 'destroy'])->name('fields.destroy');

    // User submission routes
    Route::get('/forms/{form}/submissions', [UserSubmissionController::class, 'index'])->name('submissions.index');
    Route::get('forms/{form}/submit', [UserSubmissionController::class, 'create'])->name('submissions.create');
    Route::post('forms/{form}/submit', [UserSubmissionController::class, 'store'])->name('submissions.store');
    Route::get('submissions/{submission}/edit', [UserSubmissionController::class, 'edit'])->name('submissions.edit');
    Route::put('submissions/{submission}', [UserSubmissionController::class, 'update'])->name('submissions.update');
    // web.php

    Route::get('/submissions/{submission}', [UserSubmissionController::class, 'show'])->name('submissions.show');

});
