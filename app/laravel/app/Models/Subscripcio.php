<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscripcio extends Model {
    protected $table = 'subscripcions';
    protected $fillable = ['tipus', 'preu', 'data_inici', 'data_fi', 'targeta_id', 'client_id'];
    public $timestamps = true;

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function targeta()
    {
        return $this->belongsTo(TargetaUsuari::class, 'targeta_id');
    }
}