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

<script>
    function getCodigo()
	{	    
	    var cat_id = $('#cat_id').val();

        $.get('{{ url('information') }}/create/ajax-state-cat?cat_id=' + cat_id,
         function(data) {
                $('#prod_cod').val(data);
        });

	}

	window.onload=function() {
			getCodigo();
	}
</script>
@endsection
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-8 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Nueva Producto</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/producto/crear">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Código</label>
									<div>
										<input type="text" readonly="" class="form-control text-uppercase" name="prod_cod" id="prod_cod" value="-">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Descripción</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="prod_desc" value="{{ old('ent_cont') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Observaciones</label>
							<div>
								<input type="text" class="form-control" name="prod_obs" value="{{ old('ent_cont') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Proveedor</label>
							<div>
								<select name="ent_id" id="ent_id" class="form-control text-uppercase">
									@foreach ($entidad as $entidades)
									   <option  value='{{$entidades->ent_id}}'>{{$entidades->ent_rz}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Exonerado de IGV</label>
							<div>
								<input type="radio" checked="checked" class="radio-inline" name="prod_exo" value="SI">Sí
								<input type="radio" class="radio-inline" name="prod_exo" value="NO">No
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Categoría</label>
									<div>
										<select name="cat_id" id="cat_id" class="form-control text-uppercase" onchange="getCodigo()">
											@foreach ($categorias as $categoria)
											   <option  value='{{$categoria->cat_id}}'>{{$categoria->cat_desc}}</option>
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
											   <option  value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Crear
								</button>
								<a href="/validado/producto" class="btn btn-danger" role="button">Cancelar</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
