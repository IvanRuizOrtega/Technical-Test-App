<?php

use Illuminate\Support\Facades\Route;

use App\Constants\Constant;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\IdentificationTypeController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CourseSubjectController;
use App\Http\Controllers\StudentNoteController;
use App\Http\Controllers\StudentSubjectNoteController;

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

Route::get('/', function () 
{
    return redirect()->route('login');
});

Route::middleware([Constant::AUTH])->group(function () 
{
    Route::get('/dashboard', function () 
    {
        return redirect()->route('students.index');

    })->name('dashboard');


    Route::resources(
        [
            'courses'  => CourseController::class,

            'identification-types' => IdentificationTypeController::class,

            'periods'  => PeriodController::class,

            'subjects' => SubjectController::class,

            'students' => StudentController::class,            
        ], 
        [
            'except' => ['show'] 
        ]
    );   
    
    Route::resources(
        [
            'students.subjects.notes'  => StudentSubjectNoteController::class,            
        ], 
        [
            'only' => ['index']
        ]
    );

    Route::resources(
        [
            'students.notes'  => StudentNoteController::class,            
        ], 
        [
            'only' => ['index', 'create', 'store']
        ]
    );

    Route::resources(
        [
            'courses.subjects'  => CourseSubjectController::class,            
        ], 
        [
            'only' => ['index', 'destroy']
        ]
    );

});


require __DIR__.'/auth.php';
