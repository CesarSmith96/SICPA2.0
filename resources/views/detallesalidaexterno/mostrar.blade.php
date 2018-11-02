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
		{{Session::get('error')}}
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
					<h6 class="card-title">Comprobante</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
	            	</div>
				</div>

			<div class="card-body border-success-400">
				<table class="table table-bordered table-hover datatable-basic table-xs">
					<tr>
						<th>Nro.</th>
						<th>Tipo</th>
						<th>RUC</th>
						<th>Razón Social</th>
						<th>Fecha</th>
						<th>Subtotal</th>
						<th>IGV</th>
						<th>Total</th>								
						
					</tr>
					<tr>
						<th>{{$ieexterno->ie_comp}}</th>
						<th>{{$ieexterno->ie_tcomp}}</th>
						<th>{{$ieexterno->ie_ruc}}</th>
						<th>{{$ieexterno->ie_rz}}</th>
						<th>{{date('d/m/Y', strtotime($ieexterno->ie_fecha))}}</th>
						<th>{{$moneda}} {{number_format($ieexterno->ie_subt,2,'.',',')}}</th>
						<th>{{$moneda}} {{number_format($ieexterno->ie_igv,2,'.',',')}}</th>
						<th>{{$moneda}} {{number_format($ieexterno->ie_tot,2,'.',',')}}</th>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-8 col-centered">
		<div class="card border-success-400">
			<div class="card-body border-success-400">
				<a href="/validado/detallesalidaexterno/crear?ie_id={{$ieexterno->ie_id}}" class="btn btn-success" role="button">+</a>
				<table class="table table-bordered table-hover datatable-basic table-xs">
					<thead>
						<tr>
							<th>Cantidad</th>
							<th>Descripción</th>
							<th width="130">Precio Unitario</th>
							<th width="130">Precio Total</th>
							<th>Acciones</th>
						</tr>
					</thead>
				
				@if(sizeof($detalleies)>0)
					

					@foreach ($detalleies as $detalleie)
						<tr>
							<td>{{floatval($detalleie->die_cant)}}</td>
							<td>{{$detalleie->die_desc}}</td>
							<td><div style="display:inline; float:left">{{$moneda}}</div><div style="display:inline; float:right">{{number_format($detalleie->die_prec,2,'.',',')}}</div></td>
							<td><div style="display:inline; float:left">{{$moneda}}</div><div style="display:inline; float:right">{{number_format($detalleie->die_cant*$detalleie->die_prec,2,'.',',')}}</div></td>
							<td class="text-center">
								<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
								<div class='dropdown-menu dropdown-menu-right'>
									<a href="/validado/detallesalidaexterno/editar?die_id={{$detalleie->die_id}}" class="btn btn-primary dropdown-item" role="button"><i class="icon-reset"></i>Editar</a>
									<a href="/validado/detallesalidaexterno/eliminar?die_id={{$detalleie->die_id}}" onclick="return confirm('Esta seguro que desea eliminar?')" class="btn btn-danger dropdown-item"><i class="icon-cancel-square2"></i>Eliminar</a>
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
				<a href="/validado/salidaexterno" class="btn bg-transparent text-white border-white border-2">Regresar</a>
			</div>
		</div>
	</div>
</div>
@endsection
