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
@endsection
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-8 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Editar Nota de Debito</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/ndebito/editar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="comp_id" id="comp_id" value="{{$comprobante->comp_id}}" >
						<input type="hidden" name="comp_ref_id" id="comp_ref_id" value="{{$comprobante->comp_ref}}" >
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_nro" id="comp_nro"  value="{{$comprobante->comp_nro}}">
									</div>
									<input type="text" id="label" style="border-width:0;font-size: 15px; color:red" readonly="readonly">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tipo de Nota de Crédito</label>
									<div>
										<select class="form-control text-uppercase" name="tcompinc_id" id="tcompinc_id" onchange="gettipoinc(this)">
										   @foreach ($tipocomprobanteincs as $tipocomprobanteinc)
										   		<option  value='{{$tipocomprobanteinc->tcompinc_id}}'>{{$tipocomprobanteinc->tcompinc_desc}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nro</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_ref" id="comp_ref"  value="{{$comprobante_ref->comp_nro}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Cliente</label>
									<div>
										<input type="text" disabled="" class="form-control text-uppercase" name="ent_rz" id="ent_rz" value="{{$comprobante->entidad->ent_rz}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tipo Comprobante</label>
									<div>
										<input type="text" disabled="" class="form-control text-uppercase" name="tcomp_desc" id="tcomp_desc" value="{{$comprobante_ref->tipocomprobante->tcomp_desc}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">F. Emisión de NC</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="comp_fecha"  value="{{$comprobante->comp_fecha}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">F. de Vencimiento</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="comp_fven"  value="{{$comprobante->comp_fven}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
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
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Condición</label>
									<div>
										<select class="form-control text-uppercase" name="comp_cond" onchange="getcondicion(this)">
											@if($comprobante->comp_cond=='AL CONTADO')
												<option selected>AL CONTADO</option>
												<option >MUESTRA GRATUITA</option>
												<option >AL CREDITO</option>
												<option >Otro</option>
											@elseif($comprobante->comp_cond=='MUESTRA GRATUITA')
												<option >AL CONTADO</option>
												<option selected >MUESTRA GRATUITA</option>
												<option >AL CREDITO</option>
												<option >Otro</option>
											@elseif($comprobante->comp_cond=='AL CREDITO')
												<option >AL CONTADO</option>
												<option >MUESTRA GRATUITA</option>
												<option selected >AL CREDITO</option>
												<option >Otro</option>
											@else
										   		<option >AL CONTADO</option>
												<option >MUESTRA GRATUITA</option>
												<option >AL CREDITO</option>
												<option selected >Otro</option>
											@endif
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Estado</label>
									<div>
										<select class="form-control text-uppercase" name="comp_est" id="comp_est">
												@if($comprobante->comp_est=='ACTIVO')
												<option selected value="ACTIVO">ACTIVO</option>
												<option value="ANULADO">ANULADO</option>
											@else
										   		<option value="ACTIVO">ACTIVO</option>
												<option selected value="ANULADO">ANULADO</option>
											@endif		
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Moneda</label>
									<div>
										<select class="form-control text-uppercase"  disabled="" name="comp_moneda" id="comp_moneda" value="">
											@if($comprobante->comp_moneda=='SOLES')
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
										<input type="text" disabled="" class="form-control" name="comp_tipcambio" id="comp_tipcambio" value="{{$comprobante->comp_tipcambio}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Monto</label>
									<div>
										<input type="text"  class="form-control text-uppercase" name="comp_tot" id="comp_tot" value="{{$comprobante->comp_tot}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Observaciones</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_obs" value="{{$comprobante->comp_obs}}">
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/ndebito" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Editar<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
