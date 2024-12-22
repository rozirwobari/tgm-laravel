<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QcAirGalon extends Model
{
    protected $table = 'qc_air_galon';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
