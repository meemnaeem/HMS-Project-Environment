<?php

use App\Custom\helper;
use Illuminate\Support\Str;
use App\Http\Livewire\Users;
use App\Http\Livewire\Friends;
use App\Http\Livewire\UserTable;
use App\Http\Livewire\Admin\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Admin\Doctor\Doctors;
use App\Http\Livewire\Admin\Review\Reviews;
use App\Http\Livewire\Admin\Users\ListUsers;
use App\Http\Livewire\Admin\Invoice\Invoices;
use App\Http\Livewire\Admin\Patient\Patients;
use App\Http\Livewire\Admin\Profile\Profiles;
use App\Http\Livewire\Admin\Setting\Settings;
use App\Http\Controllers\SpecialityController;
use App\Http\Livewire\Admin\Users1\ListUsers1;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Admin\Speciality\Specialities;
use App\Http\Livewire\Admin\Appointment\Appointments;
use App\Http\Livewire\Admin\Transaction\Transactions;
use App\Http\Livewire\Admin\InvoiceReport\InvoiceReports;

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

Route::get('/test', function () {
    return view('test');
});

Route::get('/admin/dashboard', function () {
    return 'Wellcome Admin!';
})->name('admin.dashboard');

Route::resource('tasks', TaskController::class);

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
    Route::view('messages', 'backend.admins.users.messages')->name('messages');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::prefix('hr')->name('hr.')->group(function () {
            // Route::view('/', 'backend.admins.users.index')->name('hr.index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [UserController::class, 'destroy'])->name('destroy');
            Route::view('/', 'backend.admins.users.index')->name('index');

            foreach (Helper::getRoles() as $role) {
                Route::get(Str::lower($role->name) ?? '', [UserController::class, 'index'])->name(Str::lower($role->name) ?? '');
            }
        });
        Route::prefix('appointment')->name('appointment.')->group(function () {
            Route::get('/', [Appointments::class, 'index'])->name('index');
            Route::get('/create', [Appointments::class, 'create'])->name('create');
            Route::post('/store', [Appointments::class, 'store'])->name('store');
            Route::get('/edit/{user}', [Appointments::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [Appointments::class, 'destroy'])->name('destroy');
        });
        Route::prefix('speciality')->name('speciality.')->group(function () {
            Route::get('/', [Specialities::class, 'index'])->name('index');
            Route::get('/create', [Specialities::class, 'create'])->name('create');
            Route::post('/store', [Specialities::class, 'store'])->name('store');
            Route::get('/edit/{user}', [Specialities::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [Specialities::class, 'destroy'])->name('destroy');
        });
        Route::prefix('doctor')->name('doctor.')->group(function () {
            Route::get('/', [Doctors::class, 'index'])->name('index');
            Route::get('/create', [Doctors::class, 'create'])->name('create');
            Route::post('/store', [Doctors::class, 'store'])->name('store');
            Route::get('/edit/{user}', [Doctors::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [Doctors::class, 'destroy'])->name('destroy');
        });
        Route::prefix('patients')->name('patient.')->group(function () {
            Route::get('/', [Patients::class, 'index'])->name('index');
            Route::get('/create', [Patients::class, 'create'])->name('create');
            Route::post('/store', [Patients::class, 'store'])->name('store');
            Route::get('/edit/{patient}', [Patients::class, 'edit'])->name('edit');
            Route::get('/show/{patient}', [Patients::class, 'show'])->name('show');
            Route::post('/delete/{patient}', [Patients::class, 'destroy'])->name('destroy');
        });
        Route::prefix('review')->name('review.')->group(function () {
            Route::get('/', [Reviews::class, 'index'])->name('index');
            Route::get('/create', [Reviews::class, 'create'])->name('create');
            Route::post('/store', [Reviews::class, 'store'])->name('store');
            Route::get('/edit/{user}', [Reviews::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [Reviews::class, 'destroy'])->name('destroy');
        });
        Route::prefix('transaction')->name('transaction.')->group(function () {
            Route::get('/', [Transactions::class, 'index'])->name('index');
            Route::get('/create', [Transactions::class, 'create'])->name('create');
            Route::post('/store', [Transactions::class, 'store'])->name('store');
            Route::get('/edit/{user}', [Transactions::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [Transactions::class, 'destroy'])->name('destroy');
        });
        Route::prefix('setting')->name('setting.')->group(function () {
            Route::get('/', [Settings::class, 'index'])->name('index');
            Route::get('/create', [Settings::class, 'create'])->name('create');
            Route::post('/store', [Settings::class, 'store'])->name('store');
            Route::get('/edit/{user}', [Settings::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [Settings::class, 'destroy'])->name('destroy');
        });
        Route::prefix('invoice-report')->name('invoice-report.')->group(function () {
            Route::get('/', [InvoiceReports::class, 'index'])->name('index');
            Route::get('/create', [InvoiceReports::class, 'create'])->name('create');
            Route::post('/store', [InvoiceReports::class, 'store'])->name('store');
            Route::get('/edit/{user}', [InvoiceReports::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [InvoiceReports::class, 'destroy'])->name('destroy');
        });
        Route::prefix('invoice')->name('invoice.')->group(function () {
            Route::get('/', [Invoices::class, 'index'])->name('index');
            Route::get('/create', [Invoices::class, 'create'])->name('create');
            Route::post('/store', [Invoices::class, 'store'])->name('store');
            Route::get('/edit/{user}', [Invoices::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [Invoices::class, 'destroy'])->name('destroy');
        });
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [Profiles::class, 'index'])->name('index');
            Route::get('/create', [Profiles::class, 'create'])->name('create');
            Route::post('/store', [Profiles::class, 'store'])->name('store');
            Route::get('/edit/{user}', [Profiles::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [Profiles::class, 'destroy'])->name('destroy');
        });
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [ListUsers::class, 'index'])->name('index');
            Route::get('/create', [ListUsers::class, 'create'])->name('create');
            Route::post('/store', [ListUsers::class, 'store'])->name('store');
            Route::get('/edit/{user}', [ListUsers::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [ListUsers::class, 'destroy'])->name('destroy');
        });
        Route::prefix('users1')->name('users1.')->group(function () {
            Route::get('/', [ListUsers1::class, 'index'])->name('index');
            Route::get('/create', [ListUsers1::class, 'create'])->name('create');
            Route::post('/store', [ListUsers1::class, 'store'])->name('store');
            Route::get('/edit/{user}', [ListUsers1::class, 'edit'])->name('edit');
            Route::post('/delete/{user}', [ListUsers1::class, 'destroy'])->name('destroy');
        });
    });
});
