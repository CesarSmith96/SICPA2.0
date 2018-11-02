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
						<a href="/validado/salidaexterno/crear" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
							<i class="icon-plus3"></i>
						</a>
					</div>
				</li>
				<li>
					<div data-fab-label="Imprimir">
						<form class="form-inline" role="form" method="POST" action="/validado/salidaexterno">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" name="imprimir" value="imprimir" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
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
					<h6 class="card-title">Gasto</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>
			<div class="card-body" style="overflow: auto;">
				<table class="table table-bordered table-hover datatable-basic table-xs">
					<thead>
						<tr>
							<th>Nro.</th>
							<th>Tipo</th>
							<th>RUC o DNI</th>
							<th>Razón Social</th>
							<th>Fecha</th>
							<th>Guía</th>
							<th><div style="display:inline; float:right">Subtotal</div></th>
							<th><div style="display:inline; float:right">IGV</div></th>
							<th><div style="display:inline; float:right">Total</div></th>
							<th>Moneda</th>
							<th>T. Cambio</th>
							<th>Funcionario</th>
							<th>T. Gasto</th>	
							<th>Acciones</th>	
						</tr>
					</thead>

				@if(sizeof($ieexternos)>0)
					

					@foreach ($ieexternos as $ieexterno)
						<tr>
							<td>{{$ieexterno->ie_comp}}</td>
							<td>{{$ieexterno->ie_tcomp}}</td>
							<td>{{$ieexterno->ie_ruc}}</td>
							<td>{{$ieexterno->ie_rz}}</td>
							<td>{{date('d/m/Y', strtotime($ieexterno->ie_fecha))}}</td>
							<td>{{$ieexterno->ie_guia}}</td>
							<td><div style="display:inline; float:right">{{$ieexterno->ie_subt}}</div></td>
							<td><div style="display:inline; float:right">{{$ieexterno->ie_igv}}</div></td>
							<td><div style="display:inline; float:right">{{$ieexterno->ie_tot}}</div></td>
							<td>{{$ieexterno->ie_moneda}}</td>
							<td>{{$ieexterno->ie_tipcambio}}</td>
							<td>{{$ieexterno->vendedor->vend_nom}}</td>
							<td>{{$ieexterno->ie_tipgasto}}</td>
							<td class="text-center">
								<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
								<div class='dropdown-menu dropdown-menu-right'>
									<a href="/validado/detallesalidaexterno?ie_id={{$ieexterno->ie_id}}"><img src="/images/detalle.png"  title="VER DETALLE"></a>
									<a href="/validado/salidaexterno/editar?ie_id={{$ieexterno->ie_id}}"><img src="/images/editar.png" title="EDITAR"></a>
									<a href="/validado/salidaexterno/eliminar?ie_id={{$ieexterno->ie_id}}" onclick="return confirm('Esta seguro que desea eliminar?')"><img src="/images/eliminar.png" title="ELIMINAR"></a>
								</div>
							</td>
						</tr>
					@endforeach

				@else
					<div class="alert alert-danger">
						<p>Al parecer no tiene registro de salidas</p>
					</div>
				@endif

				</table>

			</div>
		</div>
	</div>
</div>
<?php echo $ieexternos->render(); ?>
@endsection
