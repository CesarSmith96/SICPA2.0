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

	function getcondicion(sel)
	{	    
	    if(sel.value=="AL CREDITO")
	    {
	    	//$('#comp_fven').prop('disabled', false);
	    	$('#comp_fpago').prop('disabled', true);
	    	$('#tipcam').prop('disabled', true);
	    	$('#comp_banco').prop('disabled', true);
	    	$('#comp_nope').prop('disabled', true);
	    }
	    else
	    {
	    	//$('#comp_fven').prop('disabled', true);
	    	$('#comp_fpago').prop('disabled', false);
	    	$('#tipcam').prop('disabled', false);
	    	$('#comp_banco').prop('disabled', false);
	    	$('#comp_nope').prop('disabled', false);
	    }
	}

</script>
@endsection
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-8 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Venta</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/npedido/asignar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="ocv_id" value="{{$ordencv->ocv_id}}" >
						<input type="hidden" name="comp_est" value="ACTIVO" >
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_nro">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Cliente</label>
									<div>
										<select class="form-control text-uppercase" name="ent_id">
											@foreach ($entidades as $entidad)
												@if($entidad->ent_id == $ordencv->ent_id)
											   		<option selected value='{{$entidad->ent_id}}'>{{$entidad->ent_rz}}</option>
											   	@else
													<option  value='{{$entidad->ent_id}}'>{{$entidad->ent_rz}}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tipo</label>
									<div>
										<select class="form-control text-uppercase" name="tcomp_id">
										   @foreach ($tipocomprobantes as $tipocomprobante)
										   		<option  value='{{$tipocomprobante->tcomp_id}}'>{{$tipocomprobante->tcomp_desc}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Fecha</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="comp_fecha">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Guia de Remisión</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_guia">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro. Nota Pedido</label>
									<div>
										<input type="text" disabled="" class="form-control text-uppercase" name="comp_np"  value="{{$ordencv->ocv_nro}}">
									</div>
								</div>
							</div>
						</div>
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
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Condición</label>
									<div>
										<select class="form-control text-uppercase" name="comp_cond" onchange="getcondicion(this)">
												<option >AL CONTADO</option>
												<option >MUESTRA GRATUITA</option>
												<option >AL CREDITO</option>
												<option >Otro</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-6 control-label">Fecha Vencimiento</label>
									<div>
										<input type="date" class="form-control text-uppercase" id="comp_fven" name="comp_fven">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Moneda</label>
									<div>
										<select class="form-control text-uppercase" name="comp_moneda">
											@if($ordencv->ocv_moneda=='SOLES')
												<option selected value="SOLES">SOLES</option>
												<option value="DOLAR">DOLÁR AMERICANO</option>
											@else
										   		<option value="SOLES">SOLES</option>
												<option selected value="DOLAR">DOLÁR AMERICANO</option>
											@endif								   
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Fecha de Pago o Depósito</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="comp_fpago" id="comp_fpago">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tipo de Cambio</label>
									<div>
										<input type="text" id="tipcam" class="form-control text-uppercase" name="comp_tipcambio" value="{{$ordencv->ocv_tipcambio}}">Según fecha del depósito.
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Entidad Bancaria</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_banco" id="comp_banco">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro. Operación</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_nope" id="comp_nope">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Observaciones</label>
									<div>
										<textarea class="form-control text-uppercase" name="comp_obs" value="{{ old('comp_obs') }}"></textarea>
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/npedido" class="btn bg-transparent text-white border-white border-2">REGRESAR</a>
				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">ASIGNAR<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
