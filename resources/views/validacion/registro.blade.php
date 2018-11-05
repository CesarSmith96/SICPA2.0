@extends('plantillas.headersicpa')
@section('css')
<style type="text/css">
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: #81A8BA;
  color: #000000;
}
.content {
    background-image: url("{{asset('assets/img/textura.jpg')}}");
}

</style>
@endsection

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-6 col-centered">
			<div class="card border-success-400">

				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Registro</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
	            	</div>
				</div>
				<div class="card-body border-success-400">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Al parecer algo está mal.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="/validacion/registro">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						
						<div class="form-group">
							<label class="control-label">Nombre</label>
							<div>
								<input type="text" class="form-control" name="usu_nom" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label">Correo electrónico</label>
							<div>
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label">Contraseña</label>
							<div>
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label">Confirmar Contraseña</label>
							<div>
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label">Pregunta</label>
							<div>
								<input type="text" class="form-control" name="usu_preg">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label">Respuesta</label>
							<div>
								<input type="text" class="form-control" name="usu_rpta">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Registrarse
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
