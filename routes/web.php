<?php

use App\Custom\helper;
use Illuminate\Support\Str;
// use App\Http\Livewire\Friends;
// use App\Http\Livewire\Admin\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
// use App\Http\Controllers\UserController;
use App\Http\Livewire\Admin\hr\UserTable;
use App\Http\Livewire\Admin\Detail\Details;
use App\Http\Livewire\Admin\Doctor\Doctors;
use App\Http\Livewire\Admin\Review\Reviews;
use App\Http\Livewire\Admin\Users\ListUsers;
use App\Http\Livewire\Admin\Invoice\Invoices;
use App\Http\Livewire\Admin\Patient\Patients;
use App\Http\Livewire\Admin\Profile\Profiles;
// use App\Http\Controllers\SpecialityController;
// use App\Http\Livewire\Admin\Users1\ListUsers1;
// use App\Http\Controllers\AppointmentController;
use App\Http\Livewire\Admin\Setting\Settings;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Admin\UserIndex\UserIndex;
use App\Http\Livewire\Admin\Speciality\Specialities;
use App\Http\Livewire\Admin\UserProfile\UserProfile;
use App\Http\Livewire\Admin\Appointment\Appointments;
use App\Http\Livewire\Admin\Transaction\Transactions;
use App\Http\Livewire\Admin\InvoiceReport\InvoiceReports;
use App\Http\Livewire\Admin\PatientProfile\PatientProfile;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/wizard', function () {
    return view('wizard');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/admin/dashboard', function () {
    return 'Wellcome Admin!';
})->name('admin.dashboard');

Route::resource('tasks', TaskController::class);

//     Route::get('/user/{user}', ShowUser::class);
Route::get('/userslist/{user}', Details::class);

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
    Route::view('messages', 'admin.hr.messages')->name('messages');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::prefix('hr')->name('hr.')->group(function () {
            Route::get('/', UserTable::class)->name('index');

            foreach (Helper::getRoles() as $role) {
                Route::get(Str::lower($role->name) ?? '', UserTable::class)->name(Str::lower($role->name) ?? '');
            }
        });
        Route::prefix('appointment')->name('appointment.')->group(function () {
            Route::get('/', Appointments::class)->name('index');
        });
        Route::prefix('speciality')->name('speciality.')->group(function () {
            Route::get('/', Specialities::class)->name('index');
        });
        Route::prefix('doctor')->name('doctor.')->group(function () {
            Route::get('/', Doctors::class)->name('index');
        });
        Route::prefix('patient')->name('patient.')->group(function () {
            Route::get('/', Patients::class)->name('index');
        });
        Route::prefix('review')->name('review.')->group(function () {
            Route::get('/', Reviews::class)->name('index');
        });
        Route::prefix('transaction')->name('transaction.')->group(function () {
            Route::get('/', Transactions::class)->name('index');
        });
        Route::prefix('setting')->name('setting.')->group(function () {
            Route::get('/', Settings::class)->name('index');
        });
        Route::prefix('invoice-report')->name('invoice-report.')->group(function () {
            Route::get('/', InvoiceReports::class)->name('index');
        });
        Route::prefix('invoice')->name('invoice.')->group(function () {
            Route::get('/', Invoices::class)->name('index');
        });
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', Profiles::class)->name('index');
        });
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', UserProfile::class)->name('index');
            Route::get('/{user}', UserProfile::class);
        });
        Route::prefix('patient-profile')->name('patient-profile.')->group(function () {
            Route::get('/', PatientProfile::class)->name('index');
            Route::get('/{patient}', PatientProfile::class);
        });
        Route::prefix('invoice')->name('invoice.')->group(function () {
            Route::get('/', Invoices::class)->name('index');
            Route::get('/{invoice}', Invoices::class);
        });
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', ListUsers::class)->name('index');
        });
    });
});
