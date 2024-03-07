<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth'])->group(
//     function () {
//         Route::get('/dashboard', function () {
//             $role = auth()->user()->role->id;
//             switch ($role) {
//                 case 1:
//                     return redirect()->route('admin.dashboard');
//                 case 2:
//                     return redirect()->route('teacher.dashboard');
//                 case 3:
//                     return redirect()->route('student.dashboard');
//                 default:
//                     abort(403, 'Unauthorized action.');
//             }
//         })->name('dashboard');
//     });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
