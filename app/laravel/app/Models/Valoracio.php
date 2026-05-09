<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracio extends Model {
    protected $table = 'valoracions';
    protected $fillable = ['descripcio', 'estrelles', 'classe_id', 'client_id'];
    public $timestamps = true;

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
