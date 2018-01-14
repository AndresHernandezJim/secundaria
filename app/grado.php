<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grado extends Model
{
   protected $table="gradoalumno";
   protected $primaryKey="id";
   protected $fillable=[
   	'id_alumno','grado','grupo',
   ];
}
