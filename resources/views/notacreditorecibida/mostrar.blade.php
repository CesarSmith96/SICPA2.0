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
						<a href="/validado/notacreditorecibida/crear" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
							<i class="icon-plus3"></i>
						</a>
					</div>
				</li>
				<li>
					<div data-fab-label="Imprimir">
						<form class="form-inline" role="form" method="POST" action="/validado/notacreditorecibida">
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
					<h6 class="card-title">Búsqueda</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
	            	</div>
				</div>
				<div class="card-body border-success-400">
				<form class="form-horizontal" role="form" method="POST" action="/validado/notacreditorecibida">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Nro</label>
								<div>
									<input type="text" class="form-control text-uppercase" name="comp_nro">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Cliente</label>
								<div>
									<section name="intro" id="intro" style="display: block;">
										<select class="form-control" name="ent_id" id="ent_id">
											@foreach ($entidades as $entidad)
											   <option  value='{{$entidad->ent_id}}'>{{$entidad->ent_rz}}</option>
											@endforeach
										</select>
									</section>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Tipo</label>
								<div>
									<select class="form-control text-uppercase" name="tcompinc_id">
										<option  value=0>Elija Tipo</option>
									   @foreach ($tipocomprobanteincs as $tipocomprobanteinc)
									   		<option  value='{{$tipocomprobanteinc->tcompinc_id}}'>{{$tipocomprobanteinc->tcompinc_desc}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Fecha Inicio</label>
								<div>
									<input type="date" class="form-control text-uppercase" name="comp_fecha_ini">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Fecha Fin</label>
								<div>
									<input type="date" class="form-control text-uppercase" name="comp_fecha_fin">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Moneda</label>
								<div>
									<select class="form-control text-uppercase" name="comp_moneda">
										<option  value=0>Elija Moneda</option>
									   <option value="DOLAR">DOLÁR AMERICANO</option>
									   <option value="SOLES">SOLES</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Vendedor</label>
								<div>
									<select class="form-control text-uppercase" name="vend_id">
										<option  value=0>Elija Vendedor</option>
									   @foreach ($vendedores as $vendedor)
									   		<option  value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<!--<div class="form-group">
						<label>IGV</label>
						<div>
							<input type="radio" name="igv" value="C">CON IGV</input>
							<input type="radio" name="igv" value="S">SIN IGV</input>
							<input type="radio" name="igv" value="A">AMBOS</input>
						</div>
					</div>-->
					<div class="col-md-offset-0">
						</br>
						<button type="submit" name="buscar" value="buscar" class="btn btn-default">
							<img src="/images/buscar.png" title="BUSCAR">
						</button>
						<button type="submit" name="imprimir" value="imprimir" class="btn btn-default">
							<img src="/images/imprimir.png" title="IMPRIMIR">
						</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>

	<div class="col-md-12 col-centered">
		<div class="card border-success-400">
			<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Notas de Crédito</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>
			<div class="card-body">
				<table class="table table-bordered table-hover datatable-basic table-xs">
					<thead>
						<tr>
							<th>Nro.</th>
							<th>Tipo</th>
							<th>Cliente</th>
							<th>Fecha</th>
							<th>Subtotal</th>
							<th>IGV</th>
							<th>Total</th>
							<th>Moneda</th>
							<th>Tipo de Cambio</th>	
							<th width="230">Acciones</th>	
						</tr>
					</thead>

				@if(sizeof($comprobantes)>0)
					

					@foreach ($comprobantes as $comprobante)
						<tr>
							<td>{{$comprobante->comp_nro}}</td>
							<td>{{$comprobante->tipocomprobanteinc->tcompinc_desc}}</td>
							<td>{{$comprobante->entidad->ent_rz}}</td>
							<td>{{date('d/m/Y', strtotime($comprobante->comp_fecha))}}</td>
							<td>{{number_format($comprobante->comp_subt,2,'.',',')}}</td>
							<td>{{number_format($comprobante->comp_igv,2,'.',',')}}</td>
							<td>{{number_format($comprobante->comp_tot,2,'.',',')}}</td>
							<td>{{$comprobante->comp_moneda}}</td>
							<td>{{$comprobante->comp_tipcambio}}</td>
							<td class="text-center">
								<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
								<div class='dropdown-menu dropdown-menu-right'>
									<a class="btn btn-primary dropdown-item" href="/validado/detallenotacreditorecibida?comp_id={{$comprobante->comp_id}}"><img src="/images/detalle.png"  title="VER DETALLE">VER DETALLE</a>
									<a class="btn btn-primary dropdown-item" href="/validado/notacreditorecibida/editar?comp_id={{$comprobante->comp_id}}"><img src="/images/editar.png" title="EDITAR">EDITAR</a>
									<a class="btn btn-primary dropdown-item" href="/validado/notacreditorecibida/eliminar?comp_id={{$comprobante->comp_id}}" onclick="return confirm('Esta seguro que desea eliminar?')"><img src="/images/eliminar.png" title="ELIMINAR">ELIMINAR</a>
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
