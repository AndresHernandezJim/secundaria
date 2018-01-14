@extends('layouts.plantilla')

@section('contenido')
<div class="col-md-12">
	<div class="col md-2"></div>
	<div class="col-md 8">
		<div class="box box-primary">
			<div class="box-header with-border">
				<center><h3>Registro de Alumno</h3></center>
			</div>
			@if(Session::has('exito'))
		       <p style="color:green;">Alumno almacenado correctamente</p>
		    @endif
		    @if(Session::has('error'))
		       <p style="color:red;">No es posible registar al alumno,este ya se encuentra registrado</p>
		    @endif
			<form action="/modificar/alumnos" method="POST" role="form">
				{{ csrf_field() }}
				<div class="box-boddy">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-5">
							<div class="row">
								<input type="hidden" value="{{$alumno->id}}" name="idalumno">
								<div class="form-group">
									<label for="">Nombre</label>
									<input type="text" name="nombre" class="form-control" required value="{{$alumno->nombre}}">
								</div>
							</div>
							<div class="row">
								<div class="from-group">
									<label>Apellido Paterno</label>
									<input type="text" name="a_paterno" class="form-control" required value="{{$alumno->a_paterno}}">
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label>Apellido Materno</label>
									<input type="text" name="a_materno" class="form-control" value="{{$alumno->a_materno}}">
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label>CURP</label>
									<input type="text" name="curp" class="form-control" min="18"   value="{{$alumno->curp}}" readonly>
								</div>
							</div>
						</div>
						<div class="col md-3">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-5">
									<div class="form-group">
										<label >Grado</label>
						      			<input type="text" name="grado" value="{{$grado->grado}}">
									</div>
									<div class="form-group">
										<label >Grupo</label>
						      			<input type="text" name="grupo" value="{{$grado->grupo}}">
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							
							<center><h3>Datos del Padre</h3></center>
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<div class="row">
									<div class="form-group">
										<input type="hidden" name="idpadre" value="{{$padre->id}}">
										<label for="">Nombre</label>
										<input type="text" name="nombre2" class="form-control" value="{{$padre->nombre}}">
									</div>
								</div>
								<div class="row">
									<div class="from-group">
										<label>Apellido Paterno</label>
										<input type="text" name="a_paterno2" class="form-control" value="{{$padre->a_paterno}}">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Apellido Materno</label>
										<input type="text" name="a_materno2" class="form-control" value="{{$padre->a_materno}}">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Teléfono de Casa</label>
										<input type="text" class="form-control" name="tel" value="{{$padre->telefono}}">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Teléfono Celular</label>
										<input type="text" name="cel" class="form-control" value="{{$padre->celular}}">
									</div>
								</div>-->
							</div>
						</div>
						<div class="col-md-6">
							
							<center><h3>Datos de la Madre</h3></center>
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<div class="row">
									<input type="hidden" value="{{$madre->id}}" name="idmadre">
									<div class="form-group">
										<label for="">Nombre</label>
										<input type="text" name="nombre3" class="form-control" value="{{$madre->nombre}}">
									</div>
								</div>
								<div class="row">
									<div class="from-group">
										<label>Apellido Paterno</label>
										<input type="text" name="a_paterno3" class="form-control" value="{{$madre->a_paterno}}">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Apellido Materno</label>
										<input type="text" name="a_materno3" class="form-control" value="{{$madre->a_materno}}">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Teléfono de Casa</label>
										<input type="text" class="form-control" name="tel2" value="{{$madre->telefono}}">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Teléfono Celular</label>
										<input type="text" name="cel2" class="form-control" value="{{$madre->celular}}">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-1">
							<a href="/home" class="btn btn-danger">Cancelar</a>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-1">
							<button type="submit" class="btn btn-success">Guardar</button>
						</div>
					</div>
					<div class="row">
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection