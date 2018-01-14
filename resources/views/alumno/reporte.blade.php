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
				<div class="col-md-6">
					<div class="box box-warning">
						<div class="box-header">
							<center><h5>Reportar alumno</h5></center>
						</div>
						<div class="box-boddy">
							<form>
								<div class="row">
									<div class="form-group">
										<label>Nombre del Alumno</label>
										<input type="text" name="nombre" id="nombre">
									</div>	

								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header">
							<center><h5>Reportes registrados</h5></center>
						</div>
						<div class="box-boddy">
							lalalalal
						</div>
					</div>
				</div>
			</div>

			<br>
		</div>
	</div>
</div>



@endsection