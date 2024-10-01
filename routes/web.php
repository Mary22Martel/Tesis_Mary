<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\AgricultorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('homepage');

Route::get('/tienda', function () {
    return view('tienda');
})->name('tienda');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/repartidor', [RepartidorController::class, 'index'])->name('repartidor.dashboard');
    Route::get('/agricultor', [AgricultorController::class, 'index'])->name('agricultor.dashboard');
    Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.dashboard');
    Route::get('/student/dashboard', [CourseController::class, 'studentDashboard'])->name('student.dashboard');

    Route::resource('courses', CourseController::class);
    Route::resource('courses.contents', ContentController::class)->shallow();
    Route::get('/courses/purchase/{course}', [CourseController::class, 'purchase'])->name('courses.purchase');
    Route::post('/courses/purchase/{course}/confirm', [CourseController::class, 'confirmPurchase'])->name('courses.purchase.confirm');
    Route::get('/courses/confirm-purchase/{course}', [CourseController::class, 'confirmPurchasePage'])->name('courses.confirm_purchase');
    #Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('courses.my_courses');
});

//Agricultor - Productos
Route::middleware(['auth'])->group(function () {
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{product}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{product}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{product}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});

