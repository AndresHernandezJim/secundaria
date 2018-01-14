<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reporte extends Model
{
   protected $table='a_reportes';
   protected $primaryKey="id";
   protected $fillable=[
   		'id_alumno','id_motivo','docente','materia',
   ];
}
