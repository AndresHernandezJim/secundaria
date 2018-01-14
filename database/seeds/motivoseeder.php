<?php

use Illuminate\Database\Seeder;
use App\motivo;
class motivoseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motivo=new motivo;
        $motivo->descripcion="Incumplimiento de tarea o material de trabajo";
        $motivo->save();
        $motivo=new motivo;
        $motivo->descripcion="No acatar Indicaciones o sanciones";
        $motivo->save();
        $motivo=new motivo;
        $motivo->descripcion="Falta de corte de pelo o corte no adecuado";
        $motivo->save();
        $motivo=new motivo;
        $motivo->descripcion="No portar el uniforme escolar de forma correcta";
        $motivo->save();
        $motivo=new motivo;
        $motivo->descripcion="Falta de respeto al profesor(a) o Autoridades";
        $motivo->save();
        $motivo=new motivo;
        $motivo->descripcion="Falta de respeto a un alumno(a) o  compañero(a)";
        $motivo->save();
        $motivo=new motivo;
        $motivo->descripcion="No entregar reporte firmado";
        $motivo->save();
        $motivo=new motivo;
        $motivo->descripcion="Salir sin permiso del salon de clases ";
        $motivo->save();
        $motivo=new motivo;
        $motivo->descripcion="Indiciplina en el salon o taller";
        $motivo->save();
        $motivo=new motivo;
        $motivo->descripcion="Falta de respeto  a los simbolos patrios";
        $motivo->save();
        $motivo=new motivo;
        $motivo->descripcion="Daños y perjuicios al inmueble escolar";
        $motivo->save();
    }
}
