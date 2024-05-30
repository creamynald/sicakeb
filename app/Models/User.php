<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, LogsActivity;

    // Specify which attributes should be logged
    protected static $logAttributes = ['last_login_at'];

    // Log only changed attributes
    protected static $logOnlyDirty = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'opd_id',
        'email',
        'password',
        'last_login_at'
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
        'password' => 'hashed',
    ];

    public function isSuperAdmin()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'Super-Admin')
            {
                return true;
            }
        }

        return false;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['name',
                'opd_id',
                'email', 'last_login_at', 'last_login_ip'])
                ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
                ->useLogName('user');
    }

    public function opd()
    {
        return $this->belongsTo(opd::class);
    }

    public function activity(){
        return $this->hasMany(Activity::class);
    }
}
