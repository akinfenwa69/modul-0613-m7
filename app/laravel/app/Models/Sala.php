<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model {
    protected $table = 'sales';
    protected $fillable = ['tipus', 'descripcio'];
    public $timestamps = true;

    public function classes()
    {
        return $this->hasMany(Classe::class, 'sala_id');
    }
}
