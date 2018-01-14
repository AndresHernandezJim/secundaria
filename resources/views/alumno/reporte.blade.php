@extends('layouts.plantilla')

@section('contenido')
<div class="col-md-12">
	<br>
	<div class="box box-danger">
		<div class="box-header with-border">
			<center><h3>Reportes de alumnos</h3></center>
		</div>
		<div class="box-boddy">
			<div class="row">
				<div class="col-md-5">
					<div class="box box-warning">
						<div class="box-header">
							<center><h5>Reportar alumno</h5></center>
						</div>

						<div class="box-boddy">
							<div class="row">
								<div class="col-md-6"></div>
								<div class="col-md-4">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>&nbsp;Buscar</button>
								</div>
							</div>
							<br>
							<div class="col-md-1"></div>
							<div class="col-md-11">
								<form method="POST" action="/reportar/alumno">
									{{ csrf_field() }}
									<input type="hidden" name="id_alumno" id="id_alumno">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<label>Nombre del Alumno</label>
											</div>
											<div class="row">
												<div class="form-group">
													<input type="text" name="nombre" id="nombre" class="form-control">
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Grado</label>
												<input type="text" id="grado" class="form-control" readonly>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="row">
												<label>Grupo</label>
											</div>
											<div class="row">
												<div class="form-group">
													<input type="text"  id="grupo" class="form-control" readonly>
												</div>
											</div>
										</div>
										<div class="col-md-1"></div>
										<div class="col-md-6">
											<div class="row">
												<label>CURP</label>
											</div>
											<div class="row">
												<div class="form-group">
													<input type="text" id="curp" readonly class="form-control">
												</div>
											</div>
										</div>
									</div>
									<hr>
									<div class="row">
										<label>Motivo</label>
									</div>
									<div class="row">
											<select class="custom-select" id="selmotivo" name="motivo">
												@foreach($motivos as $item)
												<option value="{{$item->id}}">{{$item->descripcion}}</option>
												@endforeach
											</select>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-8">
													<label>Docente</label>
												</div>
												<div class="col-md-4">
													<center><label>Materia</label></center>
												</div>
											</div>
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<input type="text" name="docente" class="form-control">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<input type="text" name="materia" class="form-control">
													</div>
												</div>
											</div>
										</div>
									</div>
									<br>
									<div class="row">
											<button  type="submit" class="btn btn-danger">Generar reporte al alumno</button>
									</div>
								</form>
							</div>	
								
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="box box-primary">
						<div class="box-header">
							<center><h5>Reportes registrados</h5></center>
						</div>
						<div class="box-boddy">
							@if(isset($reportes))
								<div class="row">
									<div class="col-md-12">
										<table class="table table-sm table-striped table-responsive">
											<thead>
												<th>Alumno</th>
												<th>Motivo</th>
												<th>fecha</th>
											</thead>
											<tbody>
												@foreach($reportes as $item)
												<tr>
													<td>{{$item->nombrecompleto}}</td>
													<td>{{$item->motivo}}</td>
													<td>{{$item->fecha}}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
								
							@else
							
								<div class="col-md-12">
									<div class="row">
										<center><h5>No hay reportes registrados por el momento</h5></center>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>

			<br>
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
      		<br>
      	</div>
      	<div class="row" id="datos">
	      	<div class="col-md-2">
	      		
	      	</div>
	      	<div class="col-md-10">
	      		<div class="row">
	      			<select class="custom-select" id="salumno">
	      				
	      			</select>
	      		</div>
	      	</div>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
      
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
		$('#buscar').on('keyup',function(){
			var buscar=$('#buscar').val();
			if(buscar.length>3){
				
				var tipo=$('#selectipo').val();
				if(tipo==2){
					$.ajax({
						type: 'GET',
						url: '/alumno/obtener1',
						data:{
							buscar:buscar
						},
						success:function(data){
							data = JSON.parse(data);
							$( '#salumno option ' ).remove();
							$('#salumno').append('<option selected disabled>Seleccione al Alumno</option>');
							$.each(data, function(index,val){
								$('#salumno').append('<option value="'+val.id+'">'+val.nombrecompleto +'</option>');
							});
						}
					});
				}else{
					$.ajax({
						type:'GET',
						url: '/alumno/obtener2',
						data:{
							buscar:buscar
						},
						success:function(data){
							data=JSON.parse(data);
							$( '#salumno option ' ).remove();
							$('#salumno').append('<option selected disabled>Seleccione al Alumno</option>');
							$.each(data, function(index,val){
								$('#salumno').append('<option value="'+val.id+'">'+val.nombrecompleto+'</option>');
							});
						}
					});
				}
			}
		});
		$('#salumno').on('change',function(){
			var buscar=$('#salumno').val();
			$.ajax({
				type:'GET',
				url:'/alumno/obtener3',
				data:{
					buscar:buscar
				},
				success:function(data){
					data=JSON.parse(data);
					console.log(data);
					$('#nombre').val(data.nombrecompleto);
					$('#id_alumno').val(data.id);
					$('#curp').val(data.curp);
					$('#grado').val(data.grado);
					$('#grupo').val(data.grupo);
				}
			});
		});
		
	});
</script>
@endsection