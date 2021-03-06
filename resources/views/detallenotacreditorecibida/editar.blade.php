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
		<div class="col-md-8 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Editar Detalle de Comprobante</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/detallenotacreditorecibida/editar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="dcomp_id" value="{{$detallecomprobante->dcomp_id}}" >
						<input type="hidden" name="comp_id" value="{{$detallecomprobante->comp_id}}" >
						<div class="form-group">
							<label class="control-label">Cantidad</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="dcomp_cant" value="{{$detallecomprobante->dcomp_cant}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Unidad Medida</label>
							<div>
								<select class="form-control text-uppercase" name="um_id">
									@foreach ($unidadmedidas as $unidadmedida)
										@if($unidadmedida->um_id == $detallecomprobante->um_id)
									   		<option selected value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
									   	@else
											<option  value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Producto</label>
							<div>
								<select class="form-control text-uppercase" name="prod_id">
									@foreach ($productos as $producto)
										@if($producto->prod_id == $detallecomprobante->prod_id)
									   		<option selected value='{{$producto->prod_id}}'>{{$producto->prod_desc}}</option>
									   	@else
											<option  value='{{$producto->prod_id}}'>{{$producto->prod_desc}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Precio Unitario</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="dcomp_prec" value="{{$detallecomprobante->dcomp_prec}}">
							</div>
						</div>
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/detallenotacreditorecibida?comp_id={{$detallecomprobante->comp_id}}" class="btn bg-transparent text-white border-white border-2">Cancelar</a>

				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Editar<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
