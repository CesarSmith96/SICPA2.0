@extends('plantillas.headeradmin')
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
@section('javascript')
<script type="text/javascript">
</script>
<script src="{{asset('global_assets/js/plugins/cliente/datatable_cliente.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
@endsection
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-6 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Nueva Vendedor</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/vendedor/crear">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">RUC ó DNI</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_dni" value="{{ old('vend_dni') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nombre</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_nom" value="{{ old('vend_nom') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Telefono</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_tel" value="{{ old('vend_tel') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Ciudad</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_ciu" value="{{ old('vend_ciu') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Departamento</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_dpto" value="{{ old('vend_dpto') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Correo electrónico</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_obs" value="{{ old('vend_obs') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Tipo</label>
							<div>
								<select class="form-control text-uppercase" name="vend_tipo">
								   <option value="VENDEDOR">VENDEDOR</option>
								   <option value="FUNCIONARIO">FUNCIONARIO</option>
								</select>
							</div>
						</div>	
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Crear
								</button>
								<a href="/validado/vendedor" class="btn btn-danger" role="button">Cancelar</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
