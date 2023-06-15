<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    protected $fillable = [
        'nip',
        'name',
        'company_id',
        'department_id',
        'job_position_id',
        'username',
        'email',
        'ttd_users',
        'foto',
        'mobile_no',
        'password',
        'user_role_id',
        'note',
        'is_active',
        'created_by',
        'updated_by',
        'is_logged_in',
        'password_updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user_role()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function userImage()
    {
        return $this->hasOne(UserImage::class);
    }

    public function user_covid_certificate()
    {
        return $this->belongsTo(UserCovidCertificate::class);
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function jobPosition()
    {
        return $this->belongsTo(JobPosition::class, 'job_position_id', 'id');
    }

    public function visit()
    {
        return $this->hasMany(CovisTransaction::class, 'user_id', 'id');
    }

    public function user_covis()
    {
        return $this->hasMany(CovisTransaction::class, 'user_id', 'id');
    }

}
