<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\alumno;
use App\padre;
use App\grado;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function registroAlumno(){
        return view('alumno.registro'); 
    }
    public function registroa(Request $request){
        //dd($request->all());
        //recolectamos los campos para el alumno
        $nombrea=$request->nombre;
        $curp=$request->curp;
        $apata=$request->a_paterno;
        $amata=$request->a_materno;
       
       // dd($grado,$grupo); 
        // validamos si existe el alumno
        $existe=\DB::table('alumno')->where('curp',$curp)->first();

        if($existe==null){
            

            $a= new alumno;
            $a->nombre=$nombrea;
            $a->a_paterno=$apata;
            $a->a_materno=$amata;
            $a->curp=$curp;
            $a->save();
            $idalumno=$a->id;
            

            //recolectamos los campos para el padre
            $nombrep=$request->nombre2;
            $apatp=$request->a_paterno2;
            $amatp=$request->a_materno2;
            $telp=$request->tel;
            $celp=$request->cel;
            $padre=new padre;
            $padre->id_alumno=$idalumno;
            $padre->titulo="Sr.";
            $padre->nombre=$nombrep;
            $padre->a_paterno=$apatp;
            $padre->a_materno=$amatp;
            $padre->telefono=$telp;
            $padre->celular=$celp;
            $padre->save();

            //recolectamos los campos para la madre
            $nombrem=$request->nombre3;
            $apatm=$request->a_paterno3;
            $amatm=$request->a_materno3;
            $telm=$request->tel2;
            $celm=$request->cel2;
            $padre=new padre;
            $padre->id_alumno=$idalumno;
            $padre->titulo="Sra.";
            $padre->nombre=$nombrem;
            $padre->a_paterno=$apatm;
            $padre->a_materno=$amatm;
            $padre->telefono=$telm;
            $padre->celular=$celm;
            $padre->save();

            $g = new grado;
            $g->id_alumno=$idalumno;
            $g->grado=$request->grado;
            $g->grupo=$request->grupo;
            $g->save();
            //dd($g->all());
            return back()->with('exito',true);
            
        }else{
           return back()->with('error',true);
        }
    }

    public function veralumnos(){
        $data=array(
            'alumnos'=>\DB::table('alumno')->join('gradoalumno','alumno.id','=','gradoalumno.id_alumno')->select('alumno.id','alumno.curp','alumno.nombre','alumno.a_paterno','alumno.a_materno','gradoalumno.grado','gradoalumno.grupo')->get(),
        );
       //dd($data);
        return view('alumno.modifica',$data);
    }

    public function buscaalumnocurp( Request $request ){
        $data=\DB::table('alumno')->join('gradoalumno','alumno.id','=','gradoalumno.id_alumno')->select('alumno.id','alumno.curp','alumno.nombre','alumno.a_paterno','alumno.a_materno','gradoalumno.grado','gradoalumno.grupo')->where('alumno.curp','like','%'.$request->buscar.'%')->get();

        //dd($data);
       return json_encode($data); 
    }
    public function buscaalumnonombre( Request $request ){
        $data=\DB::table('alumno')->join('gradoalumno','alumno.id','=','gradoalumno.id_alumno')->select('alumno.id','alumno.curp','alumno.nombre','alumno.a_paterno','alumno.a_materno','gradoalumno.grado','gradoalumno.grupo')->where('alumno.nombre','like','%'.$request->buscar.'%')->get();

        //dd($data);
       return json_encode($data); 
    }
    
    public function modif($id){
        $idalumno=\DB::table('alumno')->select('id')->where('curp',$id)->first();
        $idalumno=$idalumno->id;
        $data=array(
            'alumno'=>\DB::table('alumno')->select('id','nombre','a_paterno','a_materno','curp')->where('id',$idalumno)->first(),
            'padre'=>\DB::table('padres')->select('id','nombre','a_paterno','a_materno','telefono','celular')->where('id_alumno',$idalumno)->where('titulo','Sr.')->first(),
            'madre'=>\DB::table('padres')->select('id','nombre','a_paterno','a_materno','telefono','celular')->where('id_alumno',$idalumno)->where('titulo','Sra.')->first(),
            'grado'=>\DB::table('gradoalumno')->select('grado','grupo')->where('id_alumno',$idalumno)->first(),
        );
        //dd($data);
        return view('alumno.modificar',$data);
    }    

    public function eliminar($id){
        //logica para borrado de alumnos
        $idalumno=\DB::table('alumno')->select('id')->where('curp',$id)->first();
        $idalumno=$idalumno->id;

        $borrarpadres=\DB::table('padres')->where('id_alumno',$idalumno)->delete();
        $borrargrados=\DB::table('gradoalumno')->where('id_alumno',$idalumno)->delete();
        $borraralumno=\DB::table('alumno')->where('id',$idalumno)->delete();
        return redirect('/alumnos/consulta')->with('exito',true);
    }
    public function modificar(Request $request){

       //dd($request->all());  

       //actualiza los datos del padre
       $padre=\DB::table('padres')->where('id',$request->idpadre)->update(['nombre'=>$request->nombre2,'a_paterno'=>$request->a_paterno2,'a_materno'=>$request->a_materno2,'telefono'=>$request->tel,'celular'=>$request->cel]);
       //actualizar los datos de la madre
       $madre=\DB::table('padres')->where('id',$request->idmadre)->update(['nombre'=>$request->nombre3,'a_paterno'=>$request->a_paterno3,'a_materno'=>$request->a_materno3,'telefono'=>$request->tel2,'celular'=>$request->cel2]);
       //actualizar los datos de grupo
       $grado=\DB::table('gradoalumno')->where('id_alumno',$request->idalumno)->update(['grado'=>$request->grado,'grupo'=>$request->grupo]);
       $alumno=\DB::table('alumno')->where('id',$request->idalumno)->update(['nombre'=>$request->nombre,'a_paterno'=>$request->a_paterno,'a_materno'=>$request->a_materno]);

       return redirect('/alumnos/consulta')->with('exito2',true);
    }
    public function reporte(){
        return view('alumno.reporte');
    }
}
