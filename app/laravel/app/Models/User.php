<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'cognom',
        'email',
        'password',
        'telefon',
        'rol'
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function targetaUsuari()
    {
        return $this->hasOne(TargetaUsuari::class, 'client_id');
    }

        public function subscripcio()
    {
        return $this->hasOne(Subscripcio::class, 'client_id');
    }

    public function reserva()
    {
        return $this->hasOne(Reserva::class);
    }

    public function valoracio()
    {
        return $this->hasOne(Valoracio::class);
    }
}
