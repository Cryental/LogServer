<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = true;

    protected $table = 'logs';

    protected $fillable = [
        'channel_id',
        'log_text'
    ];

    protected $casts = [
        'created_at'      => 'date:Y-m-d H:i:s',
        'updated_at'      => 'date:Y-m-d H:i:s',
    ];
}
