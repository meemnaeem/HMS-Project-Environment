<?php

namespace App\Models;

use App\Models\User;
use App\Models\Review;
use App\Models\Invoice;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use App\Http\Custom\Traits\updatableAndCreatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    use updatableAndCreatable;

    protected $fillable  = [
        'registration_no', 'registration_date', 'referral',
        'referred_by', 'patient_type', 'title',
        'first_name', 'last_name', 'dob', 'age',
        'gender', 'marital_status', 'blood_group',
        'email', 'description', 'phone', 'religion',
        'occupation', 'country', 'home_phone',
        'home_address', 'address_1', 'father_name', 'father_address',
        'father_phone', 'mother_name', 'mother_address',
        'mother_phone', 'same_a_patient', 'next_of_kin_phone',
        'next_of_kin_email', 'next_of_kin_address', 'payment_method',
        'symptoms', 'image', 'user_id', // As Doctor Id
        'status', 'created_by_id', 'updated_by_id'
    ];


    public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class, 'patient_id', 'id');
    }

    public function appointment(): HasMany
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'user_id');
    }

    public function review(): HasMany
    {
        return $this->hasMany(Review::class, 'patient_id', 'user_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_id', 'id');
    }
}
