<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class motivo extends Model
{
    protected $table="motivo";
    protected $primaryKey="id";
    protected $fillable=[
    	'descripcion',
    ];
}
