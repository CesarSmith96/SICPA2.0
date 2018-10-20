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

		        $.get('{{ url('information') }}/create/ajax-state-vercomprobante?comp_ref=' + comp_ref, function(data) {
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

</script>

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Editar Nota de Crédito</div>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/notacreditorecibida/editar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="comp_id" id="comp_id" value="{{$comprobante->comp_id}}" >
						<input type="hidden" name="comp_ref_id" id="comp_ref_id" value="{{$comprobante->comp_ref}}" >
						<div class="form-group">
							<label class="col-md-4 control-label">Nro</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_nro" id="comp_nro"  value="{{$comprobante->comp_nro}}">
							</div>
							<input type="text" id="label" style="border-width:0;font-size: 15px; color:red" readonly="readonly">
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Tipo de Nota de Crédito</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="tcompinc_id">
								   @foreach ($tipocomprobanteincs as $tipocomprobanteinc)							   		
								   		@if($tipocomprobanteinc->tcompinc_id == $comprobante->tcompinc_id)
											<option selected value='{{$tipocomprobanteinc->tcompinc_id}}'>{{$tipocomprobanteinc->tcompinc_desc}}</option>
										@else
											<option  value='{{$tipocomprobanteinc->tcompinc_id}}'>{{$tipocomprobanteinc->tcompinc_desc}}</option>
										@endif	
									@endforeach

								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Descripción</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_descrip" value="{{$comprobante->comp_descrip}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Nro</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_ref" id="comp_ref"  value="{{$comprobante_ref->comp_nro}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Cliente</label>
							<div class="col-md-6">
								<input type="text" disabled="" class="form-control text-uppercase" name="ent_rz" id="ent_rz" value="{{$comprobante->entidad->ent_rz}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Tipo Comprobante</label>
							<div class="col-md-6">
								<input type="text" disabled="" class="form-control text-uppercase" name="tcomp_desc" id="tcomp_desc" value="{{$comprobante_ref->tipocomprobante->tcomp_desc}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">F. Emisión de NC</label>
							<div class="col-md-6">
								<input type="date" class="form-control text-uppercase" name="comp_fecha"  value="{{$comprobante->comp_fecha}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">F. de Vencimiento</label>
							<div class="col-md-6">
								<input type="date" class="form-control text-uppercase" name="comp_fven"  value="{{$comprobante->comp_fven}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Vendedor</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="vend_id">
								   @foreach ($vendedores as $vendedor)
								   		@if($vendedor->vend_id == $comprobante->vend_id)
											<option selected value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
										@else
											<option  value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
										@endif		
									@endforeach

								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Moneda</label>
							<div class="col-md-6">
								<input type="text" disabled="" class="form-control text-uppercase" name="comp_moneda" id="comp_moneda" value="{{$comprobante->comp_moneda}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Tipo de Cambio</label>
							<div class="col-md-2">
								<input type="text" disabled="" class="form-control text-uppercase" name="comp_tipcambio" id="comp_tipcambio" value="{{$comprobante->comp_tipcambio}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Observaciones</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_obs" value="{{$comprobante->comp_obs}}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Editar
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
