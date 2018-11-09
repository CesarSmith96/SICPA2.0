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
					<h6 class="card-title">Editar Vendedor</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/vendedor/editar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="vend_id" value="{{$vendedor->vend_id}}" >
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">DNI</label>
									<div>
										<input type="text" class="form-control text-uppercase"  name="vend_dni" value="{{$vendedor->vend_dni}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nombre</label>
									<div>
										<input type="text" class="form-control text-uppercase"  name="vend_nom" value="{{$vendedor->vend_nom}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Telefono</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_tel"  value="{{$vendedor->vend_tel}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Ciudad</label>
									<div>
										<input type="text" class="form-control text-uppercase"  name="vend_ciu" value="{{$vendedor->vend_ciu}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Departamento</label>
									<div>
										<input type="text" class="form-control text-uppercase"  name="vend_dpto" value="{{$vendedor->vend_dpto}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Correo Electrónico</label>
									<div>
										<input type="text" class="form-control text-uppercase"  name="vend_obs" value="{{$vendedor->vend_obs}}">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Tipo</label>
							<div>
								<select class="form-control text-uppercase" name="vend_tipo">
								   	@if($vendedor->vend_tipo=='VENDEDOR')
									   <option selected="" value="VENDEDOR">VENDEDOR</option>
									   <option value="FUNCIONARIO">FUNCIONARIO</option>
									@else
										<option value="VENDEDOR">VENDEDOR</option>
									   	<option selected="" value="FUNCIONARIO">FUNCIONARIO</option>
									@endif
								</select>
							</div>
						</div>
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/vendedor" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Editar<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
