@extends('layouts.plantilla')
@section('navegacion')
<ul class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Inicio</a></li>
  <li class="active"><i class=" fa fa-pencil"></i> Registro de Alumno</li>
</ul>
<br>
@endsection
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
			<form action="/alumnos/registro" method="POST" role="form">
				{{ csrf_field() }}
				<div class="box-boddy">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-5">
							<div class="row">
								<div class="form-group">
									<label for="">Nombre</label>
									<input type="text" name="nombre" class="form-control" required>
								</div>
							</div>
							<div class="row">
								<div class="from-group">
									<label>Apellido Paterno</label>
									<input type="text" name="a_paterno" class="form-control" required>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label>Apellido Materno</label>
									<input type="text" name="a_materno" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label>CURP</label>
									<input type="text" name="curp" class="form-control" min="18"  required>
								</div>
							</div>
						</div>
						<div class="col md-3">
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-5">
									<div class="form-group">
										<label for="selectipo">Grado</label>
						      			<select class="custom-select" name="grado">
										  <option value="1" selected>Primero</option>
										  <option value="2">Segundo</option>
										  <option value="3">Tercero</option>
										</select>
									</div>
									<div class="form-group">
										<label for="selectipo">Grupo</label>
						      			<select class="custom-select" name="grupo">
										  <option value="A" selected>A</option>
										  <option value="B">B</option>
										  <option value="C">C</option>
										  <option value="D">D</option>
										</select>
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
										<label for="">Nombre</label>
										<input type="text" name="nombre2" class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="from-group">
										<label>Apellido Paterno</label>
										<input type="text" name="a_paterno2" class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Apellido Materno</label>
										<input type="text" name="a_materno2" class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Teléfono de Casa</label>
										<input type="text" class="form-control" name="tel">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Teléfono Celular</label>
										<input type="text" name="cel" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<center><h3>Datos de la Madre</h3></center>
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<div class="row">
									<div class="form-group">
										<label for="">Nombre</label>
										<input type="text" name="nombre3" class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="from-group">
										<label>Apellido Paterno</label>
										<input type="text" name="a_paterno3" class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Apellido Materno</label>
										<input type="text" name="a_materno3" class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Teléfono de Casa</label>
										<input type="text" class="form-control" name="tel2">
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label>Teléfono Celular</label>
										<input type="text" name="cel2" class="form-control">
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
 