<?php

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->integer('title')->nullable()->comment('Mr. Mrs. Sir. Etc.');
            $table->string('first_name')->nullable()->fulltext()->comment('first name of the patient');
            $table->string('last_name')->nullable()->fulltext()->comment('last name of the patient');
            $table->date('dob')->nullable()->comment('numbers only');
            $table->integer('age')->nullable()->comment('numbers only');
            $table->string('gender')->nullable()->comment('M = Male, F = Female');
            $table->string('registration_no')->nullable();
            $table->string('registration_date')->nullable();
            $table->string('referral')->nullable()->comment('1 = Yes, 2 = No');
            $table->string('referred_by')->nullable();
            $table->integer('patient_type')->nullable()->comment('1 = Inpatient, 2 = Outpatient');
            $table->string('image')->nullable();
            $table->string('marital_status')->nullable()->comment('S = Single, D = Divorce, M = Married');
            $table->string('blood_group')->nullable();
            $table->string('email')->nullable()->comment('Email id preferred to be contacted');
            $table->string('phone')->nullable()->comment('Phone number preferred to be contacted');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('father_name')->nullable();
            $table->text('father_address')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('mother_name')->nullable();
            $table->text('mother_address')->nullable();
            $table->string('mother_phone')->nullable();
            $table->tinyInteger('same_a_patient')->nullable()->default(0)->comment('if same as patient all the address will copy from the patient to the next of kin box');
            $table->string('next_of_kin_phone')->nullable();
            $table->string('next_of_kin_email')->nullable();
            $table->text('next_of_kin_address')->nullable();
            $table->string('payment_method')->nullable()->default(1)->comment('1 = Cash');
            $table->text('symptoms')->nullable();
            $table->text('description')->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('the user_id is the link to details in users table');
            $table->foreignIdFor(Doctor::class)->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('foreign doctor_id for doctor');
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
