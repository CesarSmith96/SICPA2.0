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
	    }
	    else
	    {
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
					<h6 class="card-title">Editar Egreso</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/salidaexterno/editar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="ie_id" value="{{$ieexterno->ie_id}}" >
						<div class="form-group">
							<label class="control-label">Nro</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ie_comp" value="{{$ieexterno->ie_comp}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">RUC</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ie_ruc" value="{{$ieexterno->ie_ruc}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Razon Social</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ie_rz" value="{{$ieexterno->ie_rz}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Funcionario</label>
							<div>
								<select class="form-control text-uppercase" name="vend_id">
								   	@foreach ($vendedores as $vendedor)
										@if($vendedor->vend_id==$ieexterno->vend_id)
								   			<option selected="" value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
								   		@else
								   			<option  value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
								   		@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Zona</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ie_zona" value="{{$ieexterno->ie_zona}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Centro de Costos</label>
							<div>
								<select class="form-control text-uppercase" name="ie_tipocc">
								   @foreach ($tipoccs as $tipocc)
								   		@if($tipocc->tcc_desc==$ieexterno->ie_tipocc)
								   			<option selected="">{{$tipocc->tcc_desc}}</option>
								   		@else
								   			<option>{{$tipocc->tcc_desc}}</option>
								   		@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Tipo de Gasto</label>
							<div>
								<select class="form-control text-uppercase" name="ie_tipgasto">
									@foreach ($tipogastos as $tipogasto)
								   		@if($tipogasto->tgasto_desc==$ieexterno->ie_tipgasto)
								   			<option selected="">{{$tipogasto->tgasto_desc}}</option>
								   		@else
								   			<option>{{$tipogasto->tgasto_desc}}</option>
								   		@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Tipo de Documento</label>
							<div>
								<select class="form-control text-uppercase" name="ie_tcomp">
								   <option selected="">{{$ieexterno->ie_tcomp}}</option>
								   <option>BOLETA</option>
								   <option>FACTURA</option>
								   <option>TICKET</option>
								   <option>OTROS</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Fecha</label>
							<div>
								<input type="date" class="form-control text-uppercase" name="ie_fecha" value="{{$ieexterno->ie_fecha}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Guia de Remisión</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ie_guia" value="{{$ieexterno->ie_guia}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Moneda</label>
							<div>
								<select class="form-control text-uppercase" name="ie_moneda" onchange="getvaltipmon(this)" value="{{$ieexterno->ie_moneda}}">
								   @if($ieexterno->ie_moneda=='SOLES')
										<option selected value="SOLES">SOLES</option>
										<option value="DOLAR">DOLÁR AMERICANO</option>
									@else
								   		<option value="SOLES">SOLES</option>
										<option selected value="DOLAR">DOLÁR AMERICANO</option>
									@endif	
								</select>
							</div>
						</div>						
						<div class="form-group">
							<label class="control-label">Tipo de Cambio</label>
							<div>
								<input type="text" id="tipcam" class="form-control text-uppercase" name="ie_tipcambio" value="{{$ieexterno->ie_tipcambio}}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Observaciones</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ie_obs" value="{{$ieexterno->ie_obs}}">
							</div>
						</div>	
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/salidaexterno" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Editar<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
