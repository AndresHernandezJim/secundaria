<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class padre extends Model
{
    protected $table="padres";
    protected $primaryKey="id";
    protected $fillable=[
    	'id_alumno','titulo','nombre','a_paterno','a_materno','telefono','celular',
    ];
}
