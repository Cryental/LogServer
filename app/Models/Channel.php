<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    public $timestamps = true;

    protected $table = 'channels';

    protected $fillable = [
        'name',
        'description'
    ];

    protected $casts = [
        'created_at'      => 'date:Y-m-d H:i:s',
        'updated_at'      => 'date:Y-m-d H:i:s',
    ];

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }
}
