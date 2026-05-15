<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use JeroenNoten\LaravelAdminLte\AdminLte;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'telefono',
        'activo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function adminlte_image()
    {
        return null;
    }

    public function adminlte_desc()
    {
        return ucfirst(str_replace('_', ' ', $this->getRoleNames()->first()));
    }

    public function adminlte_profile_url()
    {
        return route('profile.edit');
    }

    public function adminlte_logout_url()
    {
        return route('logout');
    }

    public function adminlte_menu()
    {
        return [];
    }

    public function adminlte_name()
    {
        return $this->nombre;
    }

    public function getNameAttribute()
    {
        return $this->nombre;
    }

    public function sendEmailVerificationNotification()
{
    $this->notify(new \App\Notifications\VerificarEmail);
}
}
