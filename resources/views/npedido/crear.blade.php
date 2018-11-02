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
<script type="text/javascript">
	$(setup)
	function setup() {
	    $('#intro select').zelect({ placeholder:'Selecciona Cliente...' })
	}
</script>
@endsection
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-9 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Nueva Nota de Pedido</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/npedido/crear" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="ocv_est" value="ACTIVO" >
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_nro">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Cliente</label>
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
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Fecha</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="ocv_fecha">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Dirección de Despacho</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_dirdesp" id="ocv_dirdesp"  value="{{ old('ocv_dirdesp') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Localidad</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_localidad" id="ocv_localidad"  value="{{ old('ocv_localidad') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Transporte</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_transporte" id="ocv_transporte"  value="{{ old('ocv_transporte') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Moneda</label>
									<div>
										<select class="form-control text-uppercase" name="ocv_moneda" onchange="getvaltipmon(this)">
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
										<input type="text" id="tipcam" class="form-control text-uppercase" name="ocv_tipcambio"> Según fecha del depósito.
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Vendedor</label>
									<div>
										<select class="form-control text-uppercase" name="vend_id">
											@foreach ($vendedores as $vendedor)
											   <option  value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
						        <div class="form-group">
									<label class="control-label">Entidad Bancaria</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_banco1" id="ocv_banco1"  value="{{ old('ocv_banco1') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro. Operación</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_nroop1" id="ocv_nroop1"  value="{{ old('ocv_nroop1') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Monto</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_monto1" id="ocv_monto1"  value="{{ old('ocv_monto1') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Entidad Bancaria</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_banco2" id="ocv_banco2"  value="{{ old('ocv_banco2') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro. Operación</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_nroop2" id="ocv_nroop2"  value="{{ old('ocv_nroop2') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Monto</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_monto2" id="ocv_monto2"  value="{{ old('ocv_monto2') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Observaciones</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_obs" value="{{ old('ocv_obs') }}">
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
				            <label class="control-label">Archivo</label>
				            <div>
				                <input type="file" name="ocv_doc" >
				            </div>
				        </div>

						<input type="hidden" name="ocv_subt" value="0">
						<input type="hidden" name="ocv_igv" value="0">
						<input type="hidden" name="ocv_tot" value="0">
						<input type="hidden" name="ocv_saldo" value="0">
						<input type="hidden" name="ocv_cond" value="-">
						<input type="hidden" name="ocv_tipo" value="NPedido">
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-teal-400 border-top-0">
					<a href="/validado/npedido" class="btn bg-transparent text-white border-white border-2">Atras</a>
					<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Crear y Añadir Detalle<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
