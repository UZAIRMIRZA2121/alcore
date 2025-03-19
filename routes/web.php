<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicController;
use App\Models\User;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\DelegateController;
use App\Http\Controllers\QuestionController;

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


Route::post('/login', [AuthController::class, 'login'])->name('login.credentials');
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
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        switch ($user->role) {
            case 'superadmin':
                return redirect()->route('admin.dashboard');
            case 'doctor':
                return redirect()->route('doctor.dashboard');
            case 'patient':
                return redirect()->route('patient.dashboard');
            default:
                abort(403, 'Unauthorized'); // Handle unexpected roles
        }
    })->name('dashboard');

    //--admin--route--start--//
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard'); // Fix the route definition here
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile'); // Fix the route definition here
        Route::post('/update-profile', [AdminController::class, 'updateProfile'])->name('update.profile');
        Route::post('/change-password', [AdminController::class, 'changePassword'])->name('change.password');
        Route::resource('sponsors', SponsorController::class);
        Route::resource('delegates', DelegateController::class);
        Route::resource('events', EventController::class);
        Route::get('/events/details/{id}', [EventController::class, 'details'])->name('events.details');
        Route::post('/priorities/update', [SponsorController::class, 'priorities_update'])->name('priorities.update');
        Route::get('/sponsors/{id}/meeting', [SponsorController::class, 'meeting'])->name('sponsors.meeting');
        Route::get('/get-question-answers', [DelegateController::class, 'getQuestionAnswers'])->name('get.question.answers');
        Route::resource('questions', QuestionController::class);


    });
    //--admin--route--end--//

});

// Routes for sponsors
Route::middleware(['auth:sponsor'])->group(function () {
    // Define your sponsor routes here
    Route::get('/sponsor/dashboard', [SponsorController::class, 'dashboard'])->name('sponsor.dashboard');
    Route::get('/sponsor/profile', [SponsorController::class, 'profile'])->name('sponsor.profile');
    Route::post('/sponsor/profile/update', [SponsorController::class, 'self_update'])->name('sponsor.profile.update');
    // Add more routes as needed
    Route::post('/delegates/update-priorities', [SponsorController::class, 'updatePriorities'])->name('delegates.updatePriorities');

    Route::get('/delegate/{id}', [SponsorController::class, 'delegate_show'])->name('delegate.details');

    Route::get('/sponsor/my-meeting', [SponsorController::class, 'my_meeting'])->name('sponsor.meeting');

});
