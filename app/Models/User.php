<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Review;
use App\Models\Patient;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Custom\Traits\updatableAndCreatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use updatableAndCreatable, HasRoles;

    protected $fillable = [
        // 'id',
        'title',
        'email',
        'first_name',
        'last_name',
        'username',
        'password',
        'gender',
        'dob',
        'age',
        'religion',
        'address_1',
        'address_2',
        'description',
        'image',
        'status',
        'phone',
        'created_by_id',
        'updated_by_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_by_id',
        'updated_by_id',
        'created_at',
        'updated_at',

    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtolower($value),
        );
    }

    protected function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->toDateTimeString(),
            set: fn ($value) => strtolower($value),
        );
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::where('id', 'like', '%' . $search . '%')
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%');
    }

    public function scopeUserRole(Builder $query, $request): Builder
    {
        return  $query->join('model_has_roles', function ($join) {
            $join->on('users.id', '=', 'model_has_roles.model_id')
                ->where('model_has_roles.model_type', User::class);
        })
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where(['roles.name' => $request]);
    }

    public function appointment(): HasMany
    {
        return $this->hasMany(Appointment::class, 'user_id', 'id');
    }

    public function review(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

    // public function patient(): HasMany
    // {
    //     return $this->hasMany(Patient::class, 'user_id', 'id');
    // }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_id', 'id');
    }
}
