<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'email',
        'contact_number',
        'password',
        'profile_image',
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

    public function getImageURL()
    {
        if ($this->profile_image) {
            return url('storage/' . $this->profile_image);
        }

        return 'https://api.dicebear.com/6.x/fun-emoji/svg?seed={$this->first_name}';
    }

    public function updatePassword(string $newPassword)
    {
        $this->password = Hash::make($newPassword);
        $this->save();
    }

    public function hasAnyRole($roles)
    {
        return in_array($this->role, $roles);
    }
}
