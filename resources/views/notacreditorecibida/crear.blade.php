@extends('app')

<script src="https://code.jquery.com/jquery-1.10.2.js"></script> 
<script type="text/javascript">
      $(document).ready(function () {
          	$('#comp_nro').keyup(function () {
             	var comp_nro = $('#comp_nro').val();

		        $.get('{{ url('information') }}/create/ajax-state-vercomps?comp_nro=' + comp_nro, function(data) {
		                $('#label').val(data);
		        });
          	});
			
      });
</script>
<script type="text/javascript">
      $(document).ready(function () {
          	$('#comp_ref').keyup(function () {
             	var comp_ref = $('#comp_ref').val();

		        $.get('{{ url('information') }}/create/ajax-state-vercomprobante-compra?comp_ref=' + comp_ref, function(data) {
		                $('#ent_rz').val(data.ent_rz);
                		$('#tcomp_desc').val(data.tcomp_desc);
                		$('#comp_moneda').val(data.comp_moneda);
                		$('#comp_tipcambio').val(data.comp_tipcambio);
                		$('#comp_ref_id').val(data.comp_id);

		        });

          	});
			
      });
</script>

<script type="text/javascript">
	function gettipoinc(sel)
	{	    
	    if(sel.value=="4")
	    {
	    	$('#comp_monto').prop('disabled', false);
	    }
	    else
	    {
	    	$('#comp_monto').prop('disabled', true);
	    	$('#comp_monto').val("");
	    }
	}

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
	    	$('#comp_fven').prop('disabled', false);
	    	$('#comp_fpago').prop('disabled', true);
	    	$('#tipcam').prop('disabled', true);
	    	$('#comp_banco').prop('disabled', true);
	    	$('#comp_nope').prop('disabled', true);
	    }
	    else
	    {
	    	$('#comp_fven').prop('disabled', true);
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
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Nueva Nota de Crédito</div>
				<div class="panel-body">
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/notacreditorecibida/crear">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="comp_est" value="ACTIVO" >
						<input type="hidden" name="comp_ref_id" id="comp_ref_id" value="" >
						<input type="hidden" name="tcomp_id" value="3"  > <!-- 3 es nota de credito-->
						<div class="form-group">
							<label class="col-md-4 control-label">Nro</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_nro" id="comp_nro"  value="{{ old('comp_nro') }}">
							</div>
							<input type="text" id="label" style="border-width:0;font-size: 15px; color:red" readonly="readonly">
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Tipo de Nota de Crédito</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="tcompinc_id" id="tcompinc_id" onchange="gettipoinc(this)">
								   @foreach ($tipocomprobanteincs as $tipocomprobanteinc)
								   		<option  value='{{$tipocomprobanteinc->tcompinc_id}}'>{{$tipocomprobanteinc->tcompinc_desc}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Descripción</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_descrip" value="{{ old('comp_descrip') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Nro</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_ref" id="comp_ref"  value="{{ old('comp_ref') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Cliente</label>
							<div class="col-md-6">
								<input type="text" disabled="" class="form-control text-uppercase" name="ent_rz" id="ent_rz">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Tipo Comprobante</label>
							<div class="col-md-6">
								<input type="text" disabled="" class="form-control text-uppercase" name="tcomp_desc" id="tcomp_desc">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">F. Emisión de NC</label>
							<div class="col-md-6">
								<input type="date" class="form-control text-uppercase" name="comp_fecha"  value="{{ old('comp_fecha') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">F. de Vencimiento</label>
							<div class="col-md-6">
								<input type="date" class="form-control text-uppercase" name="comp_fven"  value="{{ old('comp_fven') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Vendedor</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="vend_id">
								   @foreach ($vendedores as $vendedor)
								   		<option  value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Moneda</label>
							<div class="col-md-6">
								<input type="text" disabled="" class="form-control text-uppercase" name="comp_moneda" id="comp_moneda">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Tipo de Cambio</label>
							<div class="col-md-2">
								<input type="text" disabled="" class="form-control text-uppercase" name="comp_tipcambio" id="comp_tipcambio">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Descuento</label>
							<div class="col-md-2">
								<input type="text" disabled="" class="form-control text-uppercase" name="comp_monto" id="comp_monto">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Observaciones</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_obs" value="{{ old('comp_obs') }}">
							</div>
						</div>

						<input type="hidden" name="comp_subt" value="0">
						<input type="hidden" name="comp_igv" value="0">
						<input type="hidden" name="comp_tot" value="0">
						<input type="hidden" name="comp_saldo" value="0">

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Crear y Añadir Detalle
								</button>
								<a href="/validado/notacreditorecibida" class="btn btn-danger" role="button">Cancelar</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
