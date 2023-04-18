<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'major_id',
        'name',
        'email',
        'password',
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

    public function scopeNotAdmin($query)
    {
        return $query->with('roles')->whereHas('roles', fn($role) => $role->where('name', '!=', 'admin'));
    }

    public function scopeNotMe($query)
    {
        return $query->where('id', '!=', Auth::user()->id);
    }


    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }
}
