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
					<h6 class="card-title">Editar Producto</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/producto/editar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="prod_id" value="{{$producto->prod_id}}" >
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Código</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="prod_cod" value="{{$producto->prod_cod}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Descripción</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="prod_desc" value="{{$producto->prod_desc}}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Observaciones</label>
									<div>
										<input type="text" class="form-control" name="prod_obs" value="{{$producto->prod_obs}}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Proveedores</label>
									<div>
										<select name="ent_id" class="form-control text-uppercase">
											@foreach ($entidad as $entidades)
												@if($entidades->ent_id == $producto->ent_id)
											   		<option selected value='{{$entidades->ent_id}}'>{{$entidades->ent_rz}}</option>
											   	@else
													<option  value='{{$entidades->ent_id}}'>{{$entidades->ent_rz}}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Exonerado de IGV</label>
							<div>
								@if($producto->prod_exo == "SI")
									<input type="radio" checked="checked" class="radio-inline" name="prod_exo" value="SI">Sí
									<input type="radio" class="radio-inline" name="prod_exo" value="NO">No
								@else
									<input type="radio" class="radio-inline" name="prod_exo" value="SI">Sí
									<input type="radio" checked="checked" class="radio-inline" name="prod_exo" value="NO">No
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Categoría</label>
									<div>
										<select name="cat_id" class="form-control text-uppercase">
											@foreach ($categorias as $categoria)
												@if($categoria->cat_id == $producto->cat_id)
											   		<option selected value='{{$categoria->cat_id}}'>{{$categoria->cat_desc}}</option>
											   	@else
													<option  value='{{$categoria->cat_id}}'>{{$categoria->cat_desc}}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">U. Medida en Inventario</label>
									<div>
										<select name="um_id" class="form-control text-uppercase">
											@foreach ($unidadmedidas as $unidadmedida)
											    @if($unidadmedida->um_id == $producto->um_id)
											   		<option selected value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
											   	@else
													<option  value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>	
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/producto" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Editar<i class="icon-paperplane ml-2"></i></button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
@endsection
