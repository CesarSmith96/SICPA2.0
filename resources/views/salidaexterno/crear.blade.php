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
	function getvaltipmon(sel)
	{	    
	    if(sel.value=="DOLAR")
	    {
	    	$('#moneda1').text("dólares");
	    	$('#moneda2').text("dólares");
	    	$('#moneda3').text("dólares");
	    	$('#moneda4').text("dólares");
	    }
	    else
	    {
	    	$('#moneda1').text("nuevos soles");
	    	$('#moneda2').text("nuevos soles");
	    	$('#moneda3').text("nuevos soles");
	    	$('#moneda4').text("nuevos soles");
	    	$('#tipcam').val("0.00");
	    }
	}
</script>
@endsection
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-9 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Nueva Gasto</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/salidaexterno/crear">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ie_comp">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">RUC o DNI</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ie_ruc">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Razon Social</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ie_rz">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Funcionario</label>
									<div>
										<select class="form-control text-uppercase" name="vend_id">
										   @foreach ($vendedores as $vendedor)
										   		<option  value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Zona</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ie_zona">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<!--<div class="form-group">
									<label class="control-label">Tipo de Gasto</label>
									<div>
										<select class="form-control text-uppercase" name="ie_tipgasto">
										   <option>OFICINA</option>
										   <option>ADMINISTRATIVO</option>
										</select>
									</div>
								</div>-->
								<div class="form-group">
									<label class="control-label">Centro de Costos</label>
									<div>
										<select class="form-control text-uppercase" name="ie_tipocc">
										   @foreach ($tipoccs as $tipocc)
										   		<option>{{$tipocc->tcc_desc}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tipo de Gasto</label>
									<div>
										<select class="form-control text-uppercase" name="ie_tipgasto">
										   @foreach ($tipogastos as $tipogasto)
										   		<option>{{$tipogasto->tgasto_desc}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tipo de Documento</label>
									<div>
										<select class="form-control text-uppercase" name="ie_tcomp">
										   <option>BOLETA</option>
										   <option>FACTURA</option>
										   <option>TICKET</option>
										   <option>OTROS</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Fecha</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="ie_fecha">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Guia de Remisión</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ie_guia">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Moneda</label>
									<div>
										<select class="form-control text-uppercase" name="ie_moneda" onchange="getvaltipmon(this)">
										   <option value="DOLAR">DOLÁR AMERICANO</option>
										   <option value="SOLES">SOLES</option>
										</select>
									</div>
								</div>
							</div>	
							<div class="col-md-6">					
								<div class="form-group">
									<label class="control-label">Tipo de Cambio</label>
									<div>
										<input type="text" id="tipcam" class="form-control text-uppercase" name="ie_tipcambio">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Observaciones</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ie_obs">
							</div>
						</div>

						<input type="hidden" name="ie_igv" value="0">
						<input type="hidden" name="ie_tot" value="0">
						<input type="hidden" name="ie_subt" value="0">
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
					<a href="/validado/salidaexterno" class="btn bg-transparent text-white border-white border-2">Atras</a>
					<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Crear y Añadir Detalle<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
