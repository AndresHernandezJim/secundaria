<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class retardo extends Model
{
   protected $table='retardos';
   protected $primaryKey="id";
   protected $fillable=[
   	'id_usuario','fecha','hora_entrada',
   ];
}
