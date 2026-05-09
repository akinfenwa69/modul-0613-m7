<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetaUsuari extends Model {
    protected $table = 'targetas';
    protected $fillable = ['nom_titular', 'numero_compte', 'data_validesa', 'cvv', 'tipus_targeta', 'activa', 'client_id'];
    public $timestamps = true;

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}