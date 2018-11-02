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
@endsection
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-8 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Editar Nota de Crédito</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/notacreditoemitida/editar" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="comp_id" id="comp_id" value="{{$comprobante->comp_id}}" >
						<input type="hidden" name="comp_ref_id" id="comp_ref_id" value="{{$comprobante->comp_ref}}" >
						<div class="form-group">
							<label class="control-label">Nro</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="comp_nro" id="comp_nro"  value="{{$comprobante->comp_nro}}">
							</div>
							<input type="text" id="label" style="border-width:0;font-size: 15px; color:red" readonly="readonly">
						</div>
						<div class="form-group">
							<label class="control-label">Tipo de Nota de Crédito</label>
							<div>
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
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Descripción</label>
									<div>
										<input type="text" class="form-control" name="comp_descrip" id="comp_descrip" value="{{$comprobante->comp_descrip}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_ref" id="comp_ref"  value="{{$comprobante_ref->comp_nro}}">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Cliente</label>
							<div>
								<input type="text" disabled="" class="form-control text-uppercase" name="ent_rz" id="ent_rz" value="{{$comprobante->entidad->ent_rz}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Tipo Comprobante</label>
							<div>
								<input type="text" disabled="" class="form-control text-uppercase" name="tcomp_desc" id="tcomp_desc" value="{{$comprobante_ref->tipocomprobante->tcomp_desc}}">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">F. Emisión de NC</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="comp_fecha"  value="{{$comprobante->comp_fecha}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">F. de Vencimiento</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="comp_fven"  value="{{$comprobante->comp_fven}}">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Vendedor</label>
							<div>
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
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Moneda</label>
									<div>
										<input type="text" disabled="" class="form-control text-uppercase" name="comp_moneda" id="comp_moneda" value="{{$comprobante->comp_moneda}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tipo de Cambio</label>
									<div>
										<input type="text" disabled="" class="form-control text-uppercase" name="comp_tipcambio" id="comp_tipcambio" value="{{$comprobante->comp_tipcambio}}">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Observaciones</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="comp_obs" value="{{$comprobante->comp_obs}}">
							</div>
						</div>
						<div class="form-group">
				            <label class="control-label">Archivo</label>
				            <div class="col-md-2">
				                <input type="file" name="comp_doc" >
				            </div>
				        </div>
				</div>

				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/notacreditoemitida" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Editar<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
