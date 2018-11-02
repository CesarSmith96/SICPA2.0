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
<script src="{{asset('global_assets/js/plugins/ui/prism.min.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/ui/sticky.min.js')}}"></script>
<script src="{{asset('global_assets/js/demo_pages/extra_fab.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/cliente/datatable_cliente.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>

<script type="text/javascript">

$( document ).ready(function() {
	@if (count($errors) > 0)
    	$('#editarModal').modal('show');
	@endif

	 var btnImprimir = document.getElementById("btnImprimir");
	 btnImprimir.addEventListener("click", function(){
	 	$("#print").printElement();
	 });
});

$( document ).ready(function() {
	@if (count($errors) > 0)
    	$('#crearModal').modal('show');
	@endif
});

function setEditarModal(btn){
    var prod_id = $(btn).attr( "prod_id" )

    var request = $.ajax({
        url: '/validado/producto/editar',
        type: 'GET',
        data: { prod_id: prod_id} ,
        contentType: 'application/json; charset=utf-8'
    });

    request.done(function(data) {
        $('#prod_id_editar').val(data.prod_id);
        $('#prod_cod_editar').val(data.prod_cod);
        $('#prod_desc_editar').val(data.prod_desc);
        $('#prod_obs_editar').val(data.prod_obs);
        $('#prod_exo_editar').val(data.prod_exo);

    });

    request.fail(function(jqXHR, textStatus) {
          alert(textStatus);
    });

}

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

<div id="crearModal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Nuevo Producto</h6>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn bg-success">Crear</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editarModal" tabindex="-1">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Editar Producto</h6>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
            <div class="modal-body">
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
						<input type="hidden" name="prod_id" id="prod_id_editar" >
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Código</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="prod_cod" id="prod_cod_editar">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Descripción</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="prod_desc" id="prod_desc_editar">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Observaciones</label>
									<div>
										<input type="text" class="form-control" name="prod_obs" id="prod_obs_editar">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Proveedores</label>
									<div>
										<select name="ent_id" id="ent_id" class="form-control text-uppercase">
										@foreach ($entidad as $entidades)
									   		<option  value='{{$entidades->ent_id}}'>{{$entidades->ent_rz}}</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Exonerado de IGV</label>
							<div>
								
									<input type="radio" checked="checked" class="radio-inline" name="prod_exo" value="SI">Sí
									<input type="radio" class="radio-inline" name="prod_exo" value="NO">No
								
									<input type="radio" class="radio-inline" name="prod_exo" value="SI">Sí
									<input type="radio" checked="checked" class="radio-inline" name="prod_exo" value="NO">No
								
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn bg-success">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('content')
@if (Session::has('creado'))
	<div class="alert alert-success">
		{{Session::get('creado')}}
	</div>
@endif
@if (Session::has('actualizado'))
	<div class="alert alert-success">
		{{Session::get('actualizado')}}
	</div>
@endif
@if (Session::has('eliminado'))
	<div class="alert alert-success">
		{{Session::get('eliminado')}}
	</div>
@endif
@if (Session::has('error'))
	<div class="alert alert-danger">
		{{Session::get('error')}}
	</div>
@endif

<div class="content">

	<ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="hover" id="fab-menu-affixed-demo-right">
		<li>
			<a class="fab-menu-btn btn bg-teal-400 btn-float rounded-round btn-icon">
				<i class="fab-icon-open icon-paragraph-justify3"></i>
				<i class="fab-icon-close icon-cross2"></i>
			</a>

			<ul class="fab-menu-inner">
				<li>
					<div data-fab-label="Agregar">
						<a class="btn btn-light rounded-round btn-icon btn-float bg-teal-400" data-toggle="modal" data-target="#crearModal">
							<i class="icon-plus3"></i>
						</a>
					</div>
				</li>
				<li>
					<div data-fab-label="Imprimir">							
						<button id="btnImprimir" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
							<i class="icon-printer2"></i> 
						</button>
					</div>
				</li>
				<li>
					<div data-fab-label="Exportar">
						<form class="form-inline" role="form" method="POST" action="/validado/producto">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" name="exportarxls" value="imprimir" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
							<i class="icon-file-download"></i> 
						</button>
						</form>
					</div>
				</li>
			</ul>
		</li>
	</ul>

	<div class="row">
		<div class="col-md-12 col-centered">
			<div class="card border-success-400">

				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Lista de Productos</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="reload"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-hover datatable-basic table-xs" id="print">
						<thead>
							<tr>
								<th>Código</th>
								<th>Descripción</th>
								<th>Proveedor</th>
								<th>Observaciones</th>
								<th>Exonerado</th>
								<th>U. Medida</th>
								<th>Familia</th>
								<th>Subfamilia</th>	
								<th>Acciones</th>						
							</tr>
						</thead>

					@if(sizeof($productos)>0)
						

						@foreach ($productos as $producto)
							<tr>
								<td>{{$producto->prod_cod}}</td>
								<td>{{$producto->prod_desc}}</td>
								<td>{{$producto->entidad->ent_rz}}</td>
								<td>{{$producto->prod_obs}}</td>
								<td>{{$producto->prod_exo}}</td>
								<td>{{$producto->unidadmedida->um_desc}}</td>
								<td>{{$producto->categoria->familia->fam_desc}}</td>
								<td>{{$producto->categoria->cat_desc}}</td>
								<td class="text-center">
									<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
									<div class='dropdown-menu dropdown-menu-right'>
										<a href="#" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#editarModal" prod_id="{{$producto->prod_id}}" onclick="setEditarModal(this)"><i class="icon-reset"></i>Editar</a>

										<a href="/validado/producto/eliminar?prod_id={{$producto->prod_id}}" onclick="return confirm('Esta seguro que desea eliminar?')" class="btn btn-danger dropdown-item"><i class="icon-cancel-square2"></i>Eliminar</a>
									</div>
								</td>
							</tr>
						@endforeach

					@else
						<div class="alert alert-danger">
							<p>Al parecer no tiene productos</p>
						</div>
					@endif

					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection
