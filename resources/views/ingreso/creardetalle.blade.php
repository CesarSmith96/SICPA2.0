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
		<div class="col-md-9 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Nueva Compra</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
	            	</div>
				</div>
				<div class="card-body">
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/ingreso/crear">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
											
						<table class="table">
							<tr>
								<th>Nro.</th>
								<th>Tipo</th>
								<th>Entidad</th>
								<th>Fecha</th>
								<th>Subtotal</th>
								<th>IGV</th>
								<th>Total</th>								
								
							</tr>
							<tr>
								<th><input type="text" class="form-control" name="comp_nro" value="{{$comprobante->comp_nro}}"></th>
								<th><input type="text" class="form-control" name="tcomp_id" value="{{$comprobante->tipocomprobante->tcomp_desc}}"></th>
								<th><input type="text" class="form-control" name="ent_id" value="{{$comprobante->entidad->tent_desc}}"></th>
								<th><input type="date" class="form-control" name="comp_fecha" value="{{$comprobante->comp_fecha}}"></th>
								<th><input type="text" class="form-control" name="comp_subt" value="{{$comprobante->comp_subt}}"></th>
								<th><input type="text" class="form-control" name="comp_igv" value="{{$comprobante->comp_igv}}"></th>
								<th><input type="text" class="form-control" name="comp_tot" value="{{$comprobante->comp_tot}}"></th>
							</tr>
						</table>

						<table class="table">
							<tr>
								<th>Saldo</th>
								<th>Estado</th>
								<th>Condición</th>
								<th>Moneda</th>
								<th>Tipo de Cambio</th>
							</tr>
							<tr>
								<th>
									<select class="form-control" name="comp_est">
									   <option>Activo</option>
									   <option>Inactivo</option>
									</select>
								</th>
								<th><input type="text" class="form-control" name="comp_saldo" value="{{$comprobante->comp_saldo}}"></th>
								<th><input type="text" class="form-control" name="comp_cond" value="{{$comprobante->comp_cond}}"></th>
								<th><input type="text" class="form-control" name="comp_moneda" value="{{$comprobante->comp_moneda}}"></th>
								<th><input type="text" class="form-control" name="comp_tipcambio" value="{{$comprobante->comp_tipcambio}}"></th>
							</tr>
						</table>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Crear
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
