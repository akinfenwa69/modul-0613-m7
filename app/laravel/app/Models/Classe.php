<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reserva;
use App\Models\Valoracio;
use App\Models\Sala;
use App\Models\User;

class Classe extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'tipus',
        'descripcio',
        'horari_inici',
        'horari_final',
        'dia',
        'places',
        'sala_id',
        'monitor_id'
    ];

    public $timestamps = true;

    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    public function reserves()
    {
        return $this->hasMany(Reserva::class, 'classe_id');
    }

    public function valoracions()
    {
        return $this->hasMany(Valoracio::class, 'classe_id');
    }

    public function monitor()
    {
        return $this->belongsTo(User::class, 'monitor_id');
    }
}