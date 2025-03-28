<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect()->route('students.index');
});
Route::get('/students/filter', [StudentController::class, 'filter']);

Route::resource('students', StudentController::class);
