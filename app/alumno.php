<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alumno extends Model
{
   protected $table="alumno";
   protected $primaryKey="id";
   protected $fillable=[
   		'curp','nombre','a_paterno','a_materno',
   	];
}
