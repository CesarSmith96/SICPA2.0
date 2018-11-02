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

		        $.get('{{ url('information') }}/create/ajax-state-vercompi?comp_nro=' + comp_nro, function(data) {
		                $('#label').val(data);
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
		<div class="col-md-8 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Nueva Compra</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/ingreso/crear" enctype="multipart/form-data">

						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="comp_est" value="ACTIVO" >

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_nro" id="comp_nro" value="{{ old('comp_nro') }}">								
									</div>
									<input type="text" id="label" style="border-width:0;font-size: 15px; color:red" readonly="readonly">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Proveedor</label>
									<div>
											<select class="form-control text-uppercase" name="ent_id" id="ent_id">
												@foreach ($entidades as $entidad)
											   <option  value='{{$entidad->ent_id}}'>{{$entidad->ent_rz}}</option>
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
										<input type="date" class="form-control text-uppercase" name="comp_fecha" value="{{ old('comp_fecha') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Guia de Remisión</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_guia" id="comp_guia" value="{{ old('comp_guia') }}">
									</div>
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
										<select class="form-control text-uppercase" name="comp_cond">
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
									<label class="control-label">Moneda</label>
									<div>
										<select class="form-control text-uppercase" name="comp_moneda" onchange="getvaltipmon(this)">
										   <option value="DOLAR">DOLÁR AMERICANO</option>
										   <option value="SOLES">SOLES</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Fecha de Pago o Depósito</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="comp_fpago" value="{{ old('comp_fpago') }}">
									</div>
								</div>
							</div>	
							<div class="col-md-6">											
								<div class="form-group">
									<label class="control-label">Tipo de Cambio</label>
									<div>
										<input type="text" id="tipcam" class="form-control text-uppercase" name="comp_tipcambio" value="{{ old('comp_tipcambio') }}"> Según fecha del depósito.
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Entidad Bancaria</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_banco" value="{{ old('comp_banco') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro. Operación</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_nope" value="{{ old('comp_nope') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
						            <label class="control-label">Archivo</label>
						            <div>
						                <input type="file" name="comp_doc" >
						            </div>
						        </div>
						    </div>
				    	</div>
						<input type="hidden" name="comp_subt" value="0">
						<input type="hidden" name="comp_igv" value="0">
						<input type="hidden" name="comp_tot" value="0">
						<input type="hidden" name="comp_saldo" value="0">
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
					<a href="/validado/ingreso" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
					<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Crear y Añadir Detalle <i class="icon-paperplane ml-2"></i></button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>

@endsection
