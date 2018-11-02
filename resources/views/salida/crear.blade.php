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
      $(document).ready(function () {
          	$('#comp_nro').keyup(function () {
             	var comp_nro = $('#comp_nro').val();

		        $.get('{{ url('information') }}/create/ajax-state-vercomps?comp_nro=' + comp_nro, function(data) {
		                $('#label').val(data);
		        });
          	});
			
      });
      $(document).ready(function () {
          	$('#comp_np').keyup(function () {
             	var comp_np = $('#comp_np').val();

		        $.get('{{ url('information') }}/create/ajaxnotapedido?comp_np=' + comp_np, function(data) {
		                $('#cesar').val(data);
		       
		        		//$('#desaparecer').empty();
		      
		        });
          	});
			
      });
</script>
<script type="text/javascript">
	function getvaltipmon(sel)
	{	    
	    if(sel.value=="DOLAR")
	    {
	    	$('#moneda1').text("dólares");
	    	$('#moneda2').text("dólares");
	    	$('#moneda3').text("dólares");
	    	$('#moneda4').text("dólares");
	    	$('#tipcam').val("");
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
		<div class="col-md-8 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Nueva Venta</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/salida/crear">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="comp_est" value="ACTIVO" >
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_nro" id="comp_nro"  value="{{ old('comp_nro') }}">
										<input type="text" id="label" style="border-width:0;font-size: 15px; color:red" readonly="readonly">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Guia de Remisión</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_guia"  value="{{ old('comp_guia') }}">
									</div>
								</div>
							</div>
						</div>
						
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
										<input type="date" class="form-control text-uppercase" name="comp_fecha"  value="{{ old('comp_fecha') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro. Nota Pedido</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_np" id="comp_np" value="{{ old('comp_np') }}" >

									</div>
									<input type="text" id="cesar" style="border-width:0;font-size: 15px; color:red" readonly="readonly">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</div>
							</div>
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
									<label class="control-label">Fecha Vencimiento</label>
									<div>
										<input type="date" class="form-control text-uppercase" id="comp_fven" name="comp_fven"  value="{{ old('comp_fven') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Moneda</label>
									<div>
										<select class="form-control text-uppercase" name="comp_moneda" onchange="getvaltipmon(this)">
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
										<input type="text" id="tipcam" class="form-control text-uppercase" name="comp_tipcambio"  value="{{ old('comp_tipcambio') }}">Según fecha del depósito.
									</div>
								</div>
							</div>
						</div>
						<!--<div class="form-group">
							<label class="col-md-4 control-label">Fecha de Pago o Depósito</label>
							<div class="col-md-6">
								<input type="date" class="form-control text-uppercase" name="comp_fpago" id="comp_fpago"  value="{{ old('comp_fpago') }}">
							</div>
						</div>	
						<div class="form-group">
							<label class="col-md-4 control-label">Entidad Bancaria</label>
							<div class="col-md-2">
								<input type="text" class="form-control text-uppercase" name="comp_banco" id="comp_banco"  value="{{ old('comp_banco') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Nro. Operación</label>
							<div class="col-md-2">
								<input type="text" class="form-control text-uppercase" name="comp_nope" id="comp_nope"  value="{{ old('comp_nope') }}">
							</div>
						</div>-->

						<div class="form-group">
							<label class="control-label">Observaciones</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="comp_obs" value="{{ old('comp_obs') }}">
							</div>
						</div>
						<input type="hidden" name="comp_subt" value="0">
						<input type="hidden" name="comp_igv" value="0">
						<input type="hidden" name="comp_tot" value="0">
						<input type="hidden" name="comp_saldo" value="0">
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
					<a href="/validado/salida" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
					<button type="submit" class="btn btn-outline bg-white text-white border-white border-2" id="desaparecer">Crear y Añadir Detalle<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
