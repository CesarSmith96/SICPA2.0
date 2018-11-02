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
					<h6 class="card-title">Editar Inventario</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/inventario/editar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<input type="hidden" name="inv_id" value="{{$inventario->inv_id}}" >
						<input type="hidden" name="prod_id" value="{{$inventario->prod_id}}" >
						<input type="hidden" name="um_id" value="{{$inventario->um_id}}" >
						<div class="form-group">
							<label class="control-label">Producto</label>
							<div>
								<input type="text" disabled class="form-control text-uppercase" name="prod_desc" value="{{$inventario->producto->prod_desc}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Cantidad</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="inv_cant" value="{{$inventario->inv_cant}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Unidad de Medida</label>
							<div>
								<input type="text" disabled class="form-control text-uppercase" name="um_desc" value="{{$inventario->producto->unidadmedida->um_desc}}">
							</div>
						</div>	
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/inventario" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Editar<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
