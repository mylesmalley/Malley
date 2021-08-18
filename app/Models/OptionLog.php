<?php

namespace App\Models;

use \App\Models\BaseModel;


class OptionLog extends BaseModel
{
    protected $table = "option_logs";

    protected $fillable = [
    	"type",
    	"message",
    	"user_id",
    	"option_id",
    ];

    // protected $dateFormat = "Y-m-d H:i:s.u";

    public function option()
    {
    	return $this->belongsTo('\App\Models\Option');
    }


    public function user()
    {
    	return $this->belongsTo('\App\Models\User');
    }

    public function setTypeAttribute( $value )
    {
    	$this->attributes['type'] = strtoupper( $value );
    }
}
