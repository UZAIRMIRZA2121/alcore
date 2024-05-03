<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DepartmentController;
use App\Models\User;

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
    return view('frontend.index');
});
Route::get('/user/logout', function () {
    
    // Check if the user is authenticated
    if (Auth::check()) {
        // Retrieve the currently authenticated user
        $user = Auth::user();
     
;        // Update the is_online field to false
        User::where('id', $user->id)->update(['is_online' => false]);

        // Log out the user
        Auth::logout();
    }
    
    // Redirect to the home page
    return redirect('/');
})->name('user.logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $userId = Auth::id(); // Get the ID of the currently authenticated user
        $user = User::find($userId); // Find the user by ID
        
        // Update is_online field to true when user accesses the dashboard
        $user->update(['is_online' => true]);
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'doctor') {
            return redirect()->route('doctor.dashboard');
        } elseif ($user->role == 'patient') {
            return redirect()->route('patient.dashboard');
        }
    })->name('dashboard');
    //--admin--route--start--//
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('doctors', DoctorController::class);
        Route::resource('departments', DepartmentController::class);
    });
    //--admin--route--end--//
    //--doctor--route--start--//
    Route::prefix('doctor')->middleware('doctor')->group(function () {
        Route::get('/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');

    });
    //--doctor--route--end--//
    //--patient--route--start--//
    Route::prefix('patient')->middleware('patient')->group(function () {
        Route::get('/dashboard', [PatientController::class, 'index'])->name('patient.dashboard');

    });
    //--patient--route--end--//
});
