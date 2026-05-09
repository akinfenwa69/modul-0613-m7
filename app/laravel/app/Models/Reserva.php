<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model {
    protected $table = 'reserves';
    protected $fillable = ['data_de_reserva', 'classe_id', 'client_id'];
    public $timestamps = true;
    
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
