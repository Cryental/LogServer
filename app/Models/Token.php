<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public $timestamps = true;

    protected $table = 'tokens';

    protected $fillable = [
        'token'
    ];

    protected $casts = [
        'created_at'      => 'date:Y-m-d H:i:s',
        'updated_at'      => 'date:Y-m-d H:i:s',
    ];
}
