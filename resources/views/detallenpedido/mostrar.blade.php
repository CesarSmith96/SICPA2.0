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
@if (Session::has('error'))
	<div class="alert alert-danger">
		<strong>{{Session::get('error')}}</strong>
	</div>
@endif
@if (Session::has('creado'))
	<div class="alert alert-success">
		{{Session::get('creado')}}
	</div>
@endif
@if (Session::has('actualizado'))
	<div class="alert alert-success">
		{{Session::get('actualizado')}}
	</div>
@endif
@if (Session::has('eliminado'))
	<div class="alert alert-success">
		{{Session::get('eliminado')}}
	</div>
@endif

<div class="content">
	<div class="col-md-8 col-centered">
		<div class="card border-success-400">
			<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Orden de Nota de Pedido</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>

			<div class="card-body border-success-400">
				<table class="table table-bordered table-hover datatable-basic table-xs">
					<tr>
						<th>Nro.</th>
						<th>Proveedor</th>
						<th>Fecha</th>
						<th>Subtotal</th>
						<th>IGV</th>
						<th>Total</th>								
						
					</tr>
					<tr>
						<th>{{$ordencv->ocv_nro}}</th>
						<th>{{$ordencv->entidad->ent_rz}}</th>
						<th>{{date('d/m/Y', strtotime($ordencv->ocv_fecha))}}</th>
						<th>{{$moneda}} {{number_format($ordencv->ocv_subt,2,'.',',')}}</th>
						<th>{{$moneda}} {{number_format($ordencv->ocv_igv,2,'.',',')}}</th>
						<th>{{$moneda}} {{number_format($ordencv->ocv_tot,2,'.',',')}}</th>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-8 col-centered">
		<div class="card border-success-400">
			<div class="card-body border-success-400">
				<a href="/validado/detallenpedido/crear?ocv_id={{$ordencv->ocv_id}}" class="btn btn-success" role="button">+</a>

				<table class="table table-bordered table-hover datatable-basic table-xs">
					<thead>
						<tr>
							<th>Cantidad</th>
							<th>Unidad</th>
							<th>Producto</th>
							<th width="130">Precio Unitario</th>
							<th width="130">Precio Total</th>
							<th>Acciones</th>
						</tr>
					</thead>
				
				@if(sizeof($detalleordencvs)>0)
					

					@foreach ($detalleordencvs as $detalleordencv)
						<tr>
							<td>{{rtrim($detalleordencv->docv_cant,'.0')}}</td>
							<td>{{$detalleordencv->unidadproducto->unidadmedida->um_desc}}</td>
							<td>{{$detalleordencv->unidadproducto->producto->prod_desc}}</td>
							<td><div style="display:inline; float:left">{{$moneda}}</div><div style="display:inline; float:right">{{number_format($detalleordencv->docv_prec,2,'.',',')}}</div></td>
							<td><div style="display:inline; float:left">{{$moneda}}</div><div style="display:inline; float:right">{{number_format($detalleordencv->docv_cant*$detalleordencv->docv_prec,2,'.',',')}}</div></td>
							<td class="text-center">
								<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
								<div class='dropdown-menu dropdown-menu-right'>
									<a href="/validado/detallenpedido/eliminar?docv_id={{$detalleordencv->docv_id}}" onclick="return confirm('Esta seguro que desea eliminar?')" class="btn btn-danger dropdown-item"><i class="icon-cancel-square2"></i>Eliminar</a>
								</div>
							</td>
						</tr>
					@endforeach
					
				@else
					<div class="alert alert-danger">
						<p>Al parecer no tiene productos</p>
					</div>
				@endif

				</table>

			</div>
			<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/npedido" class="btn bg-transparent text-white border-white border-2">Regresar</a>
			</div>
		</div>
	</div>
</div>
@endsection
