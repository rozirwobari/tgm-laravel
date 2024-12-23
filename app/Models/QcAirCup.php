<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QcAirCup extends Model
{
    protected $table = 'qc_air_cup';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
