<?php

namespace App\Models;

class BlueprintLog extends BaseModel
{
    protected $table = 'blueprint_logs';

    protected $fillable = [
        'type',
        'message',
        'user_id',
        'blueprint_id',
    ];

    public function blueprint()
    {
        return $this->belongsTo('\App\Models\Blueprint');
    }

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = strtoupper($value);
    }
}
