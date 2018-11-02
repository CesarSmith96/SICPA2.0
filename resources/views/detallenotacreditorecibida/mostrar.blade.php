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
<script type="text/javascript">

	

	function borrarColumna()
	{
	  var fila;
	  fila=document.getElementById("tabla").getElementsByTagName('tr');
	  ultimaColumna=fila.length-1;
	  for(var i=0;ultimaColumna;i++)
	  {
	  	fila[i].getElementsByTagName('td')[5].style.display="none";
	  }
	}

	function deshabilitar()
	{
		var tcompinc_cod= <?php echo $comprobante->tipocomprobanteinc->tcompinc_cod; ?>

		if(tcompinc_cod=='1' || tcompinc_cod=='2' || tcompinc_cod=='6')
		{
			$('#crear').attr("disabled",true);
			$('#eliminar').attr("disabled",true);
			borrarColumna();
		}
		
	}



</script>
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

<body onload="deshabilitar()">
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
						<th>RUC o DNI</th>
						<th>Cliente</th>
						<th>Fecha</th>
						<th>Subtotal</th>
						<th>IGV</th>
						<th>Total</th>								
						
					</tr>
					<tr>
						<th>{{$comprobante->comp_nro}}</th>
						<th>{{$comprobante->tipocomprobante->tcomp_desc}}</th>
						<th>{{$comprobante->entidad->ent_ruc}}</th>
						<th>{{$comprobante->entidad->ent_rz}}</th>
						<th>{{date('d/m/Y', strtotime($comprobante->comp_fecha))}}</th>
						<th>{{$moneda}} {{number_format($comprobante->comp_subt,2,'.',',')}}</th>
						<th>{{$moneda}} {{number_format($comprobante->comp_igv,2,'.',',')}}</th>
						<th>{{$moneda}} {{number_format($comprobante->comp_tot,2,'.',',')}}</th>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="col-md-8 col-centered">
		<div class="card border-success-400">
			<div class="card-body border-success-400">
				<a href="/validado/detallenotacreditorecibida/crear?comp_id={{$comprobante->comp_id}}" id="crear" class="btn btn-success" role="button">+</a>
				<br/><br/>

				<table id="tabla" class="table table-bordered table-hover datatable-basic table-xs">
					<thead>
						<tr>
							<td><strong>Cantidad</strong></td>
							<td><strong>Unidad</strong></td>
							<td><strong>Producto</strong></td>
							<td width="130"><strong>Precio Unitario</strong></td>
							<td width="130"><strong>Precio Total</strong></td>
							<td><strong>Acciones</strong></td>
						</tr>
					</thead>
				
				@if(sizeof($detallecomprobantes)>0)
					

					@foreach ($detallecomprobantes as $detallecomprobante)
						<tr>
							<td>{{floatval($detallecomprobante->dcomp_cant)}}</td>
							<td>{{$detallecomprobante->unidadproducto->unidadmedida->um_desc}}</td>
							<td>{{$detallecomprobante->unidadproducto->producto->prod_desc}}</td>
							<td><div style="display:inline; float:left">{{$moneda}}</div><div style="display:inline; float:right">{{number_format($detallecomprobante->dcomp_prec,2,'.',',')}}</div></td>
							<td><div style="display:inline; float:left">{{$moneda}}</div><div style="display:inline; float:right">{{number_format($detallecomprobante->dcomp_cant*$detallecomprobante->dcomp_prec,2,'.',',')}}</div></td>
							<td class="text-center">
								<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
								<div class='dropdown-menu dropdown-menu-right'>
									<a id="eliminar" href="/validado/detallenotacreditorecibida/eliminar?dcomp_id={{$detallecomprobante->dcomp_id}}" onclick="return confirm('Esta seguro que desea eliminar?')" class="btn btn-danger dropdown-item"><i class="icon-cancel-square2"></i>Eliminar</a>
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
				<a href="/validado/notacreditorecibida" class="btn bg-transparent text-white border-white border-2">Regresar</a>

				<a href="/validado/detallenotacreditorecibida/generartxt?comp_id={{$comprobante->comp_id}}" class="btn btn-outline bg-white text-white border-white border-2" role="button">Generar Txt <i class="icon-paperplane ml-2"></i></a>
			</div>
		</div>
	</div>
</div>
</body>
@endsection
