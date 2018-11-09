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
<script src="{{asset('global_assets/js/plugins/cliente/datatable_cliente.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script type="text/javascript">

$( document ).ready(function() {
	@if (count($errors) > 0)
		$('#crearModal').modal('show');
	@endif
});

/*function setEditarModal(btn){
	
    var vend_id = $(btn).attr( "vend_id" )

    var request = $.ajax({
        url: '/validado/vendedor/editar',
        type: 'GET',
        data: { vend_id: vend_id} ,
        contentType: 'application/json; charset=utf-8'
    });

    request.done(function(data) {
    	
        $('#vend_id_editar').val(data.vend_id);
        $('#vend_dni_editar').val(data.vend_dni);
        $('#vend_nom_editar').val(data.vend_nom);
        $('#vend_tel_editar').val(data.vend_tel);
        $('#vend_ciu_editar').val(data.vend_ciu);
        $('#vend_dpto_editar').val(data.vend_dpto);
        $('#vend_obs_editar').val(data.vend_obs);
        $('#vend_tipo_editar').val(data.vend_tipo);
        $('#vend_tip_editar').text(data.vend_tipo);


    });

    request.fail(function(jqXHR, textStatus) {
          alert(textStatus);
    });

}*/
</script>
@endsection
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
<div id="crearModal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Nueva Vendedor</h6>
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

				<form class="form-horizontal" role="form" method="POST" action="/validado/vendedor/crear">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">RUC ó DNI</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_dni" value="{{ old('vend_dni') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nombre</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_nom" value="{{ old('vend_nom') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Telefono</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_tel" value="{{ old('vend_tel') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Ciudad</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_ciu" value="{{ old('vend_ciu') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Departamento</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_dpto" value="{{ old('vend_dpto') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Correo electrónico</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="vend_obs" value="{{ old('vend_obs') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Tipo</label>
							<div>
								<select class="form-control text-uppercase" name="vend_tipo">
								   <option value="VENDEDOR">VENDEDOR</option>
								   <option value="FUNCIONARIO">FUNCIONARIO</option>
								</select>
							</div>
						</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn bg-success">Crear</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!--<div class="modal fade" id="editarModal" tabindex="-1">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Editar Vendedor</h6>
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
                <form class="form-horizontal" role="form" method="POST" action="/validado/vendedor/editar">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="vend_id" id="vend_id_editar" readonly="">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">DNI</label>
								<div>
									<input type="text" class="form-control text-uppercase"  name="vend_dni" id="vend_dni_editar">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nombre</label>
								<div>
									<input type="text" class="form-control text-uppercase"  name="vend_nom" id="vend_nom_editar">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Telefono</label>
								<div>
									<input type="text" class="form-control text-uppercase" name="vend_tel"  id="vend_tel_editar">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Ciudad</label>
								<div>
									<input type="text" class="form-control text-uppercase"  name="vend_ciu" id="vend_ciu_editar">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Departamento</label>
								<div>
									<input type="text" class="form-control text-uppercase"  name="vend_dpto" id="vend_dpto_editar">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Correo Electrónico</label>
								<div>
									<input type="text" class="form-control text-uppercase"  name="vend_obs" id="vend_obs_editar">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Tipo</label>
						<div>
							<select class="form-control text-uppercase" name="vend_tipo" id="vend_tipo_editar">
								<option id="vend_tip_editar" selected=""></option>
							    <option value="VENDEDOR">VENDEDOR</option>
							    <option value="FUNCIONARIO">FUNCIONARIO</option>
							</select>
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
</div>-->

<div class="content">
	<ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="click">
		<li>
			<a class="fab-menu-btn btn bg-teal-400 btn-float rounded-round btn-icon" data-toggle="modal" data-target="#crearModal">
				<i class="fab-icon-open icon-plus3"></i>
				<i class="fab-icon-close icon-plus3"></i>
			</a>
		</li>
	</ul>
	<div class="row">
		<div class="col-md-12 col-centered">
			<div class="card border-success-400">
				<div class="card-header bg-dark header-elements-inline">
					<h6 class="card-title">Lista de Vendedores</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
	            	</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-hover datatable-basic table-xs">
						<thead>
							<tr>
								<th>Código</th>
								<th>RUC ó DNI</th>
								<th>Nombre</th>
								<th>Tipo</th>
								<th>Telefono</th>
								<th>Ciudad</th>
								<th>Departamento</th>
								<th>Correo</th>
								<th>Acciones</th>
							</tr>
						</thead>

					@if(sizeof($vendedores)>0)
						

						@foreach ($vendedores as $vendedor)
							<tr>
								<td>{{$vendedor->vend_id}}</td>
								<td>{{$vendedor->vend_dni}}</td>
								<td>{{$vendedor->vend_nom}}</td>
								<td>{{$vendedor->vend_tipo}}</td>
								<td>{{$vendedor->vend_tel}}</td>
								<td>{{$vendedor->vend_ciu}}</td>
								<td>{{$vendedor->vend_dpto}}</td>
								<td>{{$vendedor->vend_obs}}</td>
								<td class="text-center">
									<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
									<div class='dropdown-menu dropdown-menu-right'>
										<a href="/validado/vendedor/editar?vend_id={{$vendedor->vend_id}}" class="btn btn-primary dropdown-item"><i class="icon-reset"></i>Editar</a>
										<a href="/validado/vendedor/eliminar?vend_id={{$vendedor->vend_id}}" onclick="
										return confirm('Esta seguro que desea eliminar?')"
		    							class="btn btn-danger dropdown-item"><i class="icon-cancel-square2"></i>Eliminar</a>
		    						</div>
		    					</td>
							</tr>
						@endforeach

					@else
						<div class="alert alert-danger">
							<p>Al parecer no tiene vendedores</p>
						</div>
					@endif

					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
