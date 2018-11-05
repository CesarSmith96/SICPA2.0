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
	$(setup)
	function setup() {
	    $('#intro select').zelect({ placeholder:'Selecciona Cliente...' })
	}
</script>
@endsection
@section('content')
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

	<ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="hover" id="fab-menu-affixed-demo-right">
		<li>
			<a class="fab-menu-btn btn bg-teal-400 btn-float rounded-round btn-icon">
				<i class="fab-icon-open icon-paragraph-justify3"></i>
				<i class="fab-icon-close icon-cross2"></i>
			</a>

			<ul class="fab-menu-inner">
				<li>
					<div data-fab-label="Agregar">
						<a href="/validado/salida/crear" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
							<i class="icon-plus3"></i>
						</a>
					</div>
				</li>
				<li>
					<div data-fab-label="Exportar">
						<form class="form-inline" role="form" method="POST" action="/validado/salida">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" name="exportarxls" value="imprimir" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
							<i class="icon-printer2"></i> 
						</button>
						</form>
					</div>
				</li>
			</ul>
		</li>
	</ul>

	<div class="col-md-12 col-centered">
		<div class="card border-success-400">

			<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Ventas</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>

			<div class="card-body" style="overflow: auto;">

				<table class="table-bordered table-hover datatable-basic table-xs">
					<thead>
						<tr>
							<th width="5px">Nro.</th>
							<th width="5">Tipo</th>
							<th width="5">Cliente</th>
							<th width="5">Fecha</th>
							<th width="5">Guía</th>
							<th width="5">Subtotal</div></th>
							<th width="5">IGV</div></th>
							<th width="5">Total</div></th>
							<th width="5">Saldo</div></th>
							<th width="5">Estado</th>
							<th width="5">Condición</th>
							<th width="5">Est Fac</th>
							<th width="5">Días</th>
							<th width="5">Fech Ven</th>
							<th width="5">Moneda</th>
							<th width="10">T. Cambio</th>	
							<th width="5">Nota Pedido</th>	
							<th width="10">Acciones</th>	
						</tr>
					</thead>

				@if(sizeof($comprobantes)>0)
					

					@foreach ($comprobantes as $comprobante)
						<tr>
							<td>{{$comprobante->comp_nro}}</td>
							@if($comprobante->tipocomprobante->tcomp_desc=="Boleta")
								<td>BV</td>
							@else
								<td>FAC</td>
							@endif
							<td>{{$comprobante->entidad->ent_rz}}</td>
							<td>{{date('d/m/Y', strtotime($comprobante->comp_fecha))}}</td>
							<td>{{$comprobante->comp_guia}}</td>
							<td>{{number_format($comprobante->comp_subt,2,'.',',')}}</div></td>
							<td>{{number_format($comprobante->comp_igv,2,'.',',')}}</div></td>
							<td>{{number_format($comprobante->comp_tot,2,'.',',')}}</div></td>
							<td>{{number_format($comprobante->comp_saldo,2,'.',',')}}</div></td>
							
							<td>{{$comprobante->comp_est}}</td>
							
							<td>{{$comprobante->comp_cond}}</td>
							@if($comprobante->comp_cond=='AL CONTADO' || $comprobante->comp_saldo=='0.00')
							<td>PAGADO</td>
							@else
								<td>POR PAGAR</td>
							@endif
							@if($comprobante->comp_cond=='AL CREDITO')
							<?php $hoy=(strtotime(date('Y-m-d',strtotime($comprobante->comp_fven)))-strtotime(date('Y-m-d')))/86400; ?>
								<td>{{$hoy}}</td>
							@else
								<td>-</td>
							@endif
							@if($comprobante->comp_cond=='AL CONTADO')
								<td>-</td>
							@else
								<td>{{date('d/m/Y', strtotime($comprobante->comp_fven))}}</td>
							@endif
							<td>{{$comprobante->comp_moneda}}</td>
							<td>{{$comprobante->comp_tipcambio}}</td>
							<td>{{$comprobante->comp_np}}</td>
							<td class="text-center">
								<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
								<div class='dropdown-menu dropdown-menu-right'>

									<a class="btn btn-primary dropdown-item" href="/validado/detallesalida?comp_id={{$comprobante->comp_id}}"><img src="/images/detalle.png"  title="VER DETALLE">VER DETALLE</a>

									<a class="btn btn-primary dropdown-item" href="/validado/salida/editar?comp_id={{$comprobante->comp_id}}"><img src="/images/editar.png" title="EDITAR">EDITAR</a>

									<a class="btn btn-primary dropdown-item" href="/validado/salida/eliminar?comp_id={{$comprobante->comp_id}}" onclick="return confirm('Esta seguro que desea eliminar?')"><img src="/images/eliminar.png" title="ELIMINAR">ELIMINAR</a>
									<!--@if($comprobante->comp_cond=="AL CREDITO" || $comprobante->comp_cond=="CANCELADO")
										<a href="/validado/pago?comp_id={{$comprobante->comp_id}}"><img src="/images/pagar.png" title="REALIZAR PAGO"></a>
									@endif-->
									@if($comprobante->comp_est!='ANULADO')
										<a class="btn btn-primary dropdown-item" href="/validado/salida/sanular?comp_id={{$comprobante->comp_id}}" onclick="return confirm('Esta seguro que desea anular?')"><img src="/images/anular.png" title="ANULAR">ANULAR</a>
										<a class="btn btn-primary dropdown-item" href="/validado/notacreditoemitida/crear?comp_id={{$comprobante->comp_id}}""><img src="/images/nc.png" title="ANULAR CON NOTA DE CRÉDITO">ANULAR CON NOTA DE CRÉDITO</a>
										<a class="btn btn-primary dropdown-item" href="/validado/ndebito/crear?comp_id={{$comprobante->comp_id}}""><img src="/images/ncredito.png" title="NOTA DE DÉBITO">NOTA DE DÉBITO</a> 
									@endif
								</div>
							</td>
						</tr>
					@endforeach

				@else
					<div class="alert alert-danger">
						<p>Al parecer no tiene comprobantes</p>
					</div>
				@endif

				</table>

			</div>
		</div>
	</div>
</div>
@endsection
