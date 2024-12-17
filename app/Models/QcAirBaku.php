<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QcAirBaku extends Model
{
    protected $table = 'qc_air_baku';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
