@extends('layouts.plantilla')
@section('contenido')
<div class="col-md-12">
	<div class="col md-2"></div>
	<div class="col-md 8">
		<div class="box box-primary">
			<div class="box-header with-border">
				<center><h3>Alumnos registrados</h3></center>
			</div>
			@if(Session::has('exito'))
		       <p style="color:green;">Alumno eliminado correctamente</p>
		    @endif
		    @if(Session::has('exito2'))
		       <p style="color:green;">Datos del Alumno modificados correctamente</p>
		    @endif
		    @if(Session::has('error'))
		       <p style="color:red;">No es posible eliminar al alumno</p>
		    @endif
			<div class="box-body">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-3">
						
					</div>
					<div class="col-md-1">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>&nbsp;Buscar</button>
						
					</div>
				</div>
				<div class="row" id="datos">
					<hr>
					<div class="row" id="tabla">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<table class="table table-striped table-bordered table-sm table-responsive">
								<thead class="thead-dark">
									<th><center>Nombre</center></th>
									<th><center>Ap. Paterno</center></th>
									<th><center>Ap. Materno</center></th>
									<th><center>CURP</center></th>
									<th><center>Grado</center></th>
									<th><center>Grupo</center></th>
									<th></th>	
								</thead>
								<tbody id="datosa">
									@foreach($alumnos as $item)
										<tr>
											<td>{{$item->nombre}}</td>
											<td>{{$item->a_paterno}}</td>
											<td>{{$item->a_materno}}</td>
											<td>{{$item->curp}}</td>
											<td><center>{{$item->grado}}</center></td>
											<td><center>{{$item->grupo}}</center></td>
											<td>
												<a href="/modificar/{{$item->curp}}"><i class="fa fa-pencil"></i> </a>
												&nbsp;
												<a href="/eliminar/{{$item->curp}}"><i class="fa fa-user-times"></i></a>
											</td>
										</tr>			
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Busqueda de alumno</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-2">
      			<label for="selectipo">Buscar por</label>
      			<select class="custom-select" id="selectipo">
				  <option value="1" selected>Curp</option>
				  <option value="2">Nombre</option>
				</select>
      		</div>
      		<div class="col-md-8">
      			<center>
      				<input type="text" name="buscar" id="buscar" class="form-control">
      			</center>
      		</div>
      		
      	</div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <a href="#" id="btnbusqueda" class="btn btn-primary">Buscar</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection

@section('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnbusqueda').on('click',function(){
			var tipo=$('#selectipo').val();
			var buscar=$('#buscar').val();
			if(tipo==1){
				$.ajax({
					type:'get',
					url:'/alumno/buscar1',
					data:{
						buscar:buscar
					},
					success:function(data){
						console.log(data);
						data = JSON.parse(data);
						$('#datosa tr').remove();
						$.each(data, function(index,val){
							$('#datosa').append('<tr><td>'+val.nombre+'</td><td>'+val.a_paterno+'</td><td>'+val.a_materno+'</td><td>'+val.curp+'</td><td><center>'+val.grado+'</center></td><td><center>'+val.grupo+'</center></td><td><a href="/modificar/'+val.curp+'"><i class="fa fa-pencil"></i> </a>&nbsp;<a href="/eliminar/'+val.curp+'"><i class="fa fa-user-times"></i></a></td></tr>');
						});
					}
				});
			}else{
				$.ajax({
					type:'get',
					url:'/alumno/buscar2',
					data:{
						buscar:buscar
					},
					success:function(data){
						console.log(data);
						data = JSON.parse(data);
						$('#datosa tr').remove();
						$.each(data, function(index,val){
							$('#datosa').append('<tr><td>'+val.nombre+'</td><td>'+val.a_paterno+'</td><td>'+val.a_materno+'</td><td>'+val.curp+'</td><td><center>'+val.grado+'</center></td><td><center>'+val.grupo+'</center></td><td><a href="/modificar/'+val.curp+'"><i class="fa fa-pencil"></i> </a>&nbsp;<a href="/eliminar/'+val.curp+'"><i class="fa fa-user-times"></i></a></td></tr>');
						});
					}
				});
			}
		});
	});
</script>
@endsection


