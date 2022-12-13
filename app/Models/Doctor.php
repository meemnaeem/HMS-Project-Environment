<?php

namespace App\Models;

use App\Models\User;
use App\Models\Review;
use App\Models\Specialist;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use App\Http\Custom\Traits\updatableAndCreatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Doctor extends Model
{
    use HasFactory;
    use updatableAndCreatable;

    protected $fillable  = ['about_doctor','experience',
    'specialist_id','user_id','created_by_id', 'updated_by_id'];

    public function appointment(): HasMany
    {
        return $this->hasMany(Appointment::class, 'user_id', 'user_id');
    }

    public function review(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id', 'user_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function specialistn(): BelongsToMany
    {
        return $this->belongsToMany(Specialist::class, 'specialist_id', 'id');
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
