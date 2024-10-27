<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Student routes
    Route::get('students', [StudentController::class, 'index'])->name('student.index');
    Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('student', [StudentController::class, 'store'])->name('student.store');
    Route::get('student/{student}', [StudentController::class, 'edit'])->name('student.edit');
    Route::post('student/{student}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('student/{student}', [StudentController::class, 'destroy'])->name('student.destroy');

    // Course routes
    Route::get('courses', [CourseController::class, 'index'])->name('course.index');
    Route::get('course/create', [CourseController::class, 'create'])->name('course.create'); // Fixed method for creating
    Route::post('course', [CourseController::class, 'store'])->name('course.store');
    Route::get('course/{course}', [CourseController::class, 'edit'])->name('course.edit');
    Route::post('course/{course}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('course/{course}', [CourseController::class, 'destroy'])->name('course.destroy');

    // Exam routes
    Route::get('exams', [ExamController::class, 'index'])->name('exam.index');
    Route::get('exam/create', [ExamController::class, 'create'])->name('exam.create'); // Fixed method for creating
    Route::post('exam', [ExamController::class, 'store'])->name('exam.store');
    Route::get('exam/{exam}', [ExamController::class, 'edit'])->name('exam.edit');
    Route::post('exam/{exam}', [ExamController::class, 'update'])->name('exam.update');
    Route::delete('exam/{exam}', [ExamController::class, 'destroy'])->name('exam.destroy');

    // Result routes
    Route::get('exam/{exam}/result', [ResultController::class, 'show'])->name('result.show'); // Fixed typo: ResultControler -> ResultController
    Route::post('exam/{exam}/result', [ResultController::class, 'store'])->name('result.store');

    // Question routes
    Route::get('questions', [QuestionController::class, 'index'])->name('question.index');
    Route::get('question/create', [QuestionController::class, 'create'])->name('question.create'); // Fixed method for creating
    Route::post('question', [QuestionController::class, 'store'])->name('question.store');
    Route::get('question/{question}', [QuestionController::class, 'edit'])->name('question.edit');
    Route::post('question/{question}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');

});

require __DIR__ . '/auth.php';