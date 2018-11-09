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
		<div class="col-md-7 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Editar Cliente</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/cliente/editar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="ent_id" value="{{$entidad->ent_id}}" >
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">RUC ó DNI</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_ruc" value="{{$entidad->ent_ruc}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Razón Social</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_rz" value="{{$entidad->ent_rz}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Correo</label>
									<div>
										<input type="text" class="form-control" name="ent_correo" value="{{$entidad->ent_correo}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Dirección</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_dir" value="{{$entidad->ent_dir}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Departamento</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_dpto" value="{{$entidad->ent_dpto}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Ciudad</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_ciu" value="{{$entidad->ent_ciu}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Teléfono</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_tel" value="{{$entidad->ent_tel}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nombre de Contacto</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_cont" value="{{$entidad->ent_cont}}">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Teléfono de Contacto</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ent_ctel" value="{{$entidad->ent_ctel}}">
							</div>
						</div>
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/cliente" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Editar<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
