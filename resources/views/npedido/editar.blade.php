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
<style>
    	#hh { font-size: 16px; color: #1e1f19; background-color: #f3f3f3; padding: 10px 20px; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; }
    #hh { color: #7A7A78; }
    #intro { margin-bottom: 8px; }
    #intro:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }

    #intro .zelect {
      display: inline-block;
      background-color: white;
      min-width: 300px;
      cursor: pointer;
      line-height: 36px;
      border: 1px solid #D0D0D0;
      border-radius: 6px;
      position: relative;
    }
    #intro .zelected {
      padding-left: 10px;
    }
    #intro .zelected.placeholder {
      color: #67737A;
    }
    #intro .zelected:hover {
      border-color: #99B8BF;
      box-shadow: inset 0px 5px 8px -6px #D0D0D0;
    }
    #intro .zelect.open {
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }
    #intro .dropdown {
      background-color: white;
      border-bottom-left-radius: 5px;
      border-bottom-right-radius: 5px;
      border: 1px solid #D0D0D0;
      border-top: none;
      position: absolute;
      left:-1px;
      right:-1px;
      top: 36px;
      z-index: 2;
      padding: 3px 5px 3px 3px;
    }
    #intro .dropdown input {
      font-family: sans-serif;
      outline: none;
      font-size: 14px;
      border-radius: 4px;
      border: 1px solid #D0D0D0;
      box-sizing: border-box;
      width: 100%;
      padding: 7px 0 7px 10px;
    }
    #intro .dropdown ol {
      padding: 0;
      margin: 3px 0 0 0;
      list-style-type: none;
      max-height: 150px;
      overflow-y: scroll;
    }
    #intro .dropdown li {
      padding-left: 10px;
    }
    #intro .dropdown li.current {
      background-color: #AFB6B7;
    }
    #intro .dropdown .no-results {
      margin-left: 10px;
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
		<div class="col-md-8 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Editar Nota de Pedido</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/npedido/editar" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="ocv_id" value="{{$ordencv->ocv_id}}" >
						<input type="hidden" name="ocv_cond" value="-">
						<input type="hidden" name="ocv_tipo" value="NPEDIDO">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_nro" value="{{$ordencv->ocv_nro}}">
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
									<label class="control-label">Fecha</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="ocv_fecha" value="{{$ordencv->ocv_fecha}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Dirección de Despacho</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_dirdesp" id="ocv_dirdesp"  value="{{ $ordencv->ocv_dirdesp }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Localidad</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_localidad" id="ocv_localidad"  value="{{ $ordencv->ocv_localidad }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Transporte</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_transporte" id="ocv_transporte"  value="{{ $ordencv->ocv_transporte }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Moneda</label>
									<div>
										<select class="form-control text-uppercase" name="ocv_moneda" value="">
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
									<label class="control-label">Tipo de Cambio</label>
									<div>
										<input type="text" id="tipcam" class="form-control text-uppercase" name="ocv_tipcambio" value="{{$ordencv->ocv_tipcambio}}"> Según fecha del depósito.
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
											   
											   @if($vendedor->vend_id == $ordencv->vend_id)
											   		<option selected="" value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
											   	@else
													<option  value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
						        <div class="form-group">
									<label class="control-label">Entidad Bancaria</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_banco1" id="ocv_banco1" value="{{$ordencv->ocv_banco1}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro. Operación</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_nroop1" id="ocv_nroop1"  value="{{$ordencv->ocv_nroop1}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Monto</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_monto1" id="ocv_monto1"   value="{{$ordencv->ocv_monto1}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Entidad Bancaria</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_banco2" id="ocv_banco2" value="{{$ordencv->ocv_banco2}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro. Operación</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_nroop2" id="ocv_nroop2"  value="{{$ordencv->ocv_nroop2}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Monto</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_monto2" id="ocv_monto2"   value="{{$ordencv->ocv_monto2}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Observaciones</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ocv_obs" value="{{ $ordencv->ocv_obs }}">
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
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/npedido" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Editar<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
