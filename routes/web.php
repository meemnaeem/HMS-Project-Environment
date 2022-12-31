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
use App\Http\Livewire\Patient\Search\Search;
use App\Http\Livewire\Admin\Invoice\Invoices;
use App\Http\Livewire\Admin\Patient\Patients;
use App\Http\Livewire\Admin\Profile\Profiles;
use App\Http\Livewire\Admin\Setting\Settings;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Patient\Booking\Bookings;
use App\Http\Livewire\Admin\UserIndex\UserIndex;
use App\Http\Livewire\Patient\Calendar\Calendars;
use App\Http\Livewire\Admin\Speciality\Specialities;
use App\Http\Livewire\Admin\UserProfile\UserProfile;
use App\Http\Livewire\Admin\Appointment\Appointments;
use App\Http\Livewire\Admin\Transaction\Transactions;
// use App\Http\Controllers\SpecialityController;
// use App\Http\Livewire\Admin\Users1\ListUsers1;
// use App\Http\Controllers\AppointmentController;
use App\Http\Livewire\Admin\InvoiceReport\InvoiceReports;
use App\Http\Livewire\Admin\PatientProfile\PatientProfile;
use App\Http\Livewire\Doctor\Doctor\Doctors as DocDoctors;
use App\Http\Livewire\Doctor\Review\Reviews as DocReviews;
use App\Http\Livewire\Doctor\Social\Socials as DocSocials;
use App\Http\Livewire\Patient\Doctor\Doctors as PatDoctors;
use App\Http\Livewire\Patient\Review\Reviews as PatReviews;
use App\Http\Livewire\Patient\Social\Socials as PatSocials;
use App\Http\Livewire\Doctor\Invoice\Invoices as DocInvoices;
use App\Http\Livewire\Doctor\Message\Messages as DocMessages;
use App\Http\Livewire\Doctor\Patient\Patients as DocPatients;
use App\Http\Livewire\Doctor\Profile\Profiles as DocProfiles;
use App\Http\Livewire\Doctor\Setting\Settings as DocSettings;
use App\Http\Livewire\Patient\Invoice\Invoices as PatInvoices;
use App\Http\Livewire\Patient\Message\Messages as PatMessages;
use App\Http\Livewire\Patient\Patient\Patients as PatPatients;
use App\Http\Livewire\Patient\Profile\Profiles as PatProfiles;
use App\Http\Livewire\Patient\Setting\Settings as PatSettings;
use App\Http\Livewire\Doctor\Schedule\Schedules as DocSchedules;
use App\Http\Livewire\Patient\Schedule\Schedules as PatSchedules;
use App\Http\Livewire\Patient\Favourite\Favourites as PatFavourites;
use App\Http\Livewire\Doctor\UserProfile\UserProfile as DocUserProfile;
use App\Http\Livewire\Doctor\Speciality\Specialities as DocSpecialities;
use App\Http\Livewire\Patient\UserProfile\UserProfile as PatUserProfile;
use App\Http\Livewire\Doctor\Appointment\Appointments as Docappointments;
use App\Http\Livewire\Doctor\Transaction\Transactions as DocTransactions;
use App\Http\Livewire\Patient\Speciality\Specialities as PatSpecialities;
use App\Http\Livewire\Patient\Appointment\Appointments as Patappointments;
use App\Http\Livewire\Patient\Transaction\Transactions as PatTransactions;
use App\Http\Livewire\Doctor\InvoiceReport\InvoiceReports as DocInvoiceReports;
use App\Http\Livewire\Doctor\ChangePassword\ChangePassword as DocChangePassword;
use App\Http\Livewire\Doctor\PatientProfile\PatientProfile as DocPatientProfile;
use App\Http\Livewire\Patient\InvoiceReport\InvoiceReports as PatInvoiceReports;
use App\Http\Livewire\Patient\ChangePassword\ChangePassword as PatChangePassword;
use App\Http\Livewire\Patient\PatientProfile\PatientProfile as PatPatientProfile;

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
    Route::view('messages', 'admin.hr.messages')->name('messages');

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
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
    });
    Route::middleware(['role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/', [HomeController::class, 'dochome'])->name('dochome');
        Route::prefix('appointment')->group(function () {
            Route::get('/', DocAppointments::class)->name('appointment');
        });
        Route::prefix('speciality')->group(function () {
            Route::get('/', DocSpecialities::class)->name('speciality');
        });
        Route::prefix('doctor')->group(function () {
            Route::get('/', DocDoctors::class)->name('doctor');
        });
        Route::prefix('patient')->group(function () {
            Route::get('/', DocPatients::class)->name('patient');
        });
        Route::prefix('schedule')->group(function () {
            Route::get('/', DocSchedules::class)->name('schedule');
        });
        Route::prefix('review')->group(function () {
            Route::get('/', DocReviews::class)->name('review');
        });
        Route::prefix('message')->group(function () {
            Route::get('/', DocMessages::class)->name('message');
        });
        Route::prefix('transaction')->group(function () {
            Route::get('/', DocTransactions::class)->name('transaction');
        });
        Route::prefix('setting')->group(function () {
            Route::get('/', DocSettings::class)->name('setting');
        });
        Route::prefix('invoice-report')->group(function () {
            Route::get('/', DocInvoiceReports::class)->name('invoice-report');
        });
        Route::prefix('invoice')->group(function () {
            Route::get('/', DocInvoices::class)->name('invoice');
        });
        Route::prefix('profile')->group(function () {
            Route::get('/', DocProfiles::class)->name('profile');
        });
        Route::prefix('social')->group(function () {
            Route::get('/', DocSocials::class)->name('social');
        });
        Route::prefix('change-password')->group(function () {
            Route::get('/', DocChangePassword::class)->name('change-password');
        });
        Route::prefix('user')->group(function () {
            Route::get('/', DocUserProfile::class)->name('user');
            Route::get('/{user}', DocUserProfile::class);
        });
        Route::prefix('patient-profile')->group(function () {
            Route::get('/', DocPatientProfile::class)->name('patient-profile');
            Route::get('/{patient}', DocPatientProfile::class);
        });
        Route::prefix('invoice')->group(function () {
            Route::get('/', DocInvoices::class)->name('invoice');
            Route::get('/{invoice}', DocInvoices::class);
        });
    });
    Route::middleware(['role:patient'])->prefix('patient')->name('patient.')->group(function () {
        Route::get('/', [HomeController::class, 'pathome'])->name('home');
        Route::prefix('appointment')->group(function () {
            Route::get('/', PatAppointments::class)->name('appointment');
        });
        Route::prefix('favourite')->group(function () {
            Route::get('/', PatFavourites::class)->name('favourite');
        });
        Route::prefix('search')->group(function () {
            Route::get('/', Search::class)->name('search');
        });
        Route::prefix('booking')->group(function () {
            Route::get('/', Bookings::class)->name('booking');
        });
        Route::prefix('calendar')->group(function () {
            Route::get('/', Calendars::class)->name('calendar');
        });
        Route::prefix('speciality')->group(function () {
            Route::get('/', PatSpecialities::class)->name('speciality');
        });
        Route::prefix('doctor')->group(function () {
            Route::get('/', PatDoctors::class)->name('doctor');
        });
        Route::prefix('patient')->group(function () {
            Route::get('/', PatPatients::class)->name('patient');
        });
        Route::prefix('schedule')->group(function () {
            Route::get('/', PatSchedules::class)->name('schedule');
        });
        Route::prefix('review')->group(function () {
            Route::get('/', PatReviews::class)->name('review');
        });
        Route::prefix('message')->group(function () {
            Route::get('/', PatMessages::class)->name('message');
        });
        Route::prefix('transaction')->group(function () {
            Route::get('/', PatTransactions::class)->name('transaction');
        });
        Route::prefix('setting')->group(function () {
            Route::get('/', PatSettings::class)->name('setting');
        });
        Route::prefix('invoice-report')->group(function () {
            Route::get('/', PatInvoiceReports::class)->name('invoice-report');
        });
        Route::prefix('invoice')->group(function () {
            Route::get('/', PatInvoices::class)->name('invoice');
        });
        Route::prefix('profile')->group(function () {
            Route::get('/', PatProfiles::class)->name('profile');
        });
        Route::prefix('social')->group(function () {
            Route::get('/', PatSocials::class)->name('social');
        });
        Route::prefix('change-password')->group(function () {
            Route::get('/', PatChangePassword::class)->name('change-password');
        });
        Route::prefix('user')->group(function () {
            Route::get('/', PatUserProfile::class)->name('user');
            Route::get('/{user}', PatUserProfile::class);
        });
        Route::prefix('patient-profile')->group(function () {
            Route::get('/', PatPatientProfile::class)->name('patient-profile');
            Route::get('/{patient}', PatPatientProfile::class);
        });
        Route::prefix('invoice')->group(function () {
            Route::get('/', PatInvoices::class)->name('invoice');
            Route::get('/{invoice}', PatInvoices::class);
        });
    });
});
