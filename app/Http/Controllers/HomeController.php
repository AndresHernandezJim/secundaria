<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\alumno;
use App\padre;
use App\grado;
Use App\reporte;
use App\retardo;

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
    {   $raw2=\DB::raw("count(a_reportes.id_alumno) as cantidad,motivo.descripcion as motivo");
        $raw3=\DB::raw("month(a_reportes.created_at)");
        $mes=date('m');
       // dd($mes);
        $raw=\DB::raw("count(id_usuario) as cantidad,fecha");
        $raw4=\DB::raw("month(fecha)");
        $data=array(
            'dos'=>\DB::table('retardos')->select($raw)->where($raw4,$mes)->groupby('fecha')->get(),
            'uno'=>\DB::table('a_reportes')->join('motivo','a_reportes.id_motivo','=','motivo.id')->select($raw2)->where($raw3,$mes)->groupby('motivo')->get(),
        );
     // dd($data);
        return view('home',$data);
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
        $raw=\DB::raw("concat(alumno.nombre,' ',alumno.a_paterno,' ',alumno.a_materno) as nombrecompleto");
        $raw2=\DB::raw('motivo.descripcion as motivo, date(motivo.created_at) as fecha');
        $data=array(
        'motivos'=>\DB::table('motivo')->select('id','descripcion')->get(),
        'reportes'=>\DB::table('alumno')->join('a_reportes','alumno.id','=','a_reportes.id_alumno')->join('motivo','a_reportes.id_motivo','=','motivo.id')->select($raw,$raw2)->orderby('fecha','desc')->get(),
        );
        //dd($data);
        return view('alumno.reporte',$data);
    }
    public function alumno1(Request $request){
        $raw=\DB::raw("concat(nombre,' ',a_paterno,' ',a_materno) as nombrecompleto");
        $data=\DB::table('alumno')->select('id',$raw,'curp')->where('nombre','like','%'.$request->buscar.'%')->get();
        return json_encode($data);
    }
    public function alumno2(Request $request){
        $raw=\DB::raw("concat(nombre,' ',a_paterno,' ',a_materno) as nombrecompleto");
        $data=\DB::table('alumno')->select('id',$raw,'curp')->where('curp','like','%'.$request->buscar.'%')->get();
        return json_encode($data);
    }

    public function alumno3(Request $request){
        $raw=\DB::raw("concat(alumno.nombre,' ',alumno.a_paterno,' ',alumno.a_materno) as nombrecompleto");
        $data=\DB::table('alumno')->join('gradoalumno','alumno.id','=','gradoalumno.id_alumno')->select('alumno.id',$raw,'alumno.curp','gradoalumno.grado','gradoalumno.grupo')->where('alumno.id','=',$request->buscar)->first();
        return json_encode($data);
    }
    public function reportaralumno(Request $request){
        //dd($request->all());
        $repo=new reporte;
        $repo->id_alumno=$request->id_alumno;
        $repo->id_motivo=$request->motivo;
        $repo->docente=$request->docente;
        $repo->materia=$request->materia;
        $repo->save();

        return redirect('/alumnos/reporte')->with('exito',true);
        
    }

    public function retardos1(){
        $mes=date('m');
        $raw=\DB::raw("concat(alumno.nombre,' ',alumno.a_paterno,' ',alumno.a_materno) as nombrecompleto,retardos.fecha as fecha,retardos.hora_entrada as hora");
        $raw2=\DB::raw('month(fecha)');
        $data=array(
            'retrasos'=>\DB::table('alumno')->join('retardos','alumno.id','=','retardos.id_usuario')->select($raw)->where($raw2,$mes)->get(),
        );
        //dd($data);
        return view('alumno.retardos',$data);
    }
    public function retardos2(Request $request){
        //dd($request->all());
        $ret= new retardo;
        $ret->id_usuario=$request->id_alumno;
        $ret->fecha=date('Y-m-d');
        $ret->hora_entrada=$request->hora;
        $ret->save();

        return redirect('/alumno/retardos')->with('exito',true);
    }
}
