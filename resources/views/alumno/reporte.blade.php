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
							<div class="row">
								<div class="col-md-6"></div>
								<div class="col-md-4">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i>&nbsp;Buscar</button>
								</div>
							</div>
							<br>
							<div class="col-md-1"></div>
							<div class="col-md-8">
								<form>
									<div class="row">
										<div class="form-group">
											<label>Nombre del Alumno</label>
											<input type="text" name="nombre" id="nombre">
										</div>	

									</div>
									<div class="row">
										<label>Motivo</label>
									</div>
									<div class="row">
										<div class="form-control">
											
											<select class="custom-select">
												@foreach($motivos as $item)
												<option value="{{$item->id}}">{{$item->descripcion}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="form-control">
											<button  type="submit" class="btn btn-danger">Generar reporte al alumno</button>
										</div>
									</div>
								</form>
							</div>	
								
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