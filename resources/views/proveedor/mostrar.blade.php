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


$( document ).ready(function() {
	@if (count($errors) > 0)
		$('#crearModal').modal('show');
	@endif
});


/*function setEditarModal(btn){
    var ent_id = $(btn).attr( "ent_id" );

    var request = $.ajax({
        url: '/validado/proveedor/editar',
        type: 'GET',
        data: { ent_id: ent_id} ,
        contentType: 'application/json; charset=utf-8'
    });

    request.done(function(data) {
        $('#ent_id_editar').val(data.ent_id);
        $('#ent_ruc_editar').val(data.ent_ruc);
        $('#ent_rz_editar').val(data.ent_rz);
        $('#ent_correo_editar').val(data.ent_correo);
        $('#ent_dir_editar').val(data.ent_dir);
        $('#ent_ciu_editar').val(data.ent_ciu);
        $('#ent_tel_editar').val(data.ent_tel);
        $('#ent_cont_editar').val(data.ent_cont);
        $('#ent_ctel_editar').val(data.ent_ctel);

    });

    request.fail(function(jqXHR, textStatus) {
          alert(textStatus);
    });

}*/

</script>

@endsection
@section('content')


<div id="crearModal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Nuevo Proveedor</h6>
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

				<form method="post" action="/validado/proveedor/crear">
    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
    				<div class="row">
	    				<div class="form-group col-md-6">
							<label for="recipient-name" class="form-control-label">RUC</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ent_ruc" value="{{ old('ent_ruc') }}">
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="recipient-name" class="form-control-label">Razón Social</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ent_rz" value="{{ old('ent_rz') }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Correo</label>
						<div>
							<input type="text" class="form-control" name="ent_correo" value="{{ old('ent_correo') }}">
						</div>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Dirección</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_dir" value="{{ old('ent_dir') }}">
						</div>
					</div>
					<div class="row">
					<div class="form-group col-md-6">
						<label for="recipient-name" class="form-control-label">Ciudad</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_ciu" value="{{ old('ent_ciu') }}">
						</div>
					</div>
					<div class="form-group col-md-6"> 
						<label for="recipient-name" class="form-control-label">Teléfono</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_tel" value="{{ old('ent_tel') }}">
						</div>
					</div>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Nombre de Contacto</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_cont" value="{{ old('ent_cont') }}">
						</div>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Teléfono de Contacto</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_ctel" value="{{ old('ent_ctel') }}">
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
				<h6 class="modal-title">Editar Proveedor</h6>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
            <div class="modal-body">
                <form method="post" action="/validado/proveedor/editar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                    <input type="hidden" class="form-control" id="ent_id_editar" name="ent_id" readonly />
                    

                    <div class="row">
	    				<div class="form-group col-md-6">
							<label for="recipient-name" class="form-control-label">RUC</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ent_ruc" id="ent_ruc_editar">
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="recipient-name" class="form-control-label">Razón Social</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="ent_rz" id="ent_rz_editar">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Correo</label>
						<div>
							<input type="text" class="form-control" name="ent_correo" id="ent_correo_editar">
						</div>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Dirección</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_dir" id="ent_dir_editar">
						</div>
					</div>
					<div class="row">
					<div class="form-group col-md-6">
						<label for="recipient-name" class="form-control-label">Ciudad</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_ciu" id="ent_ciu_editar">
						</div>
					</div>
					<div class="form-group col-md-6"> 
						<label for="recipient-name" class="form-control-label">Teléfono</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_tel" id="ent_tel_editar">
						</div>
					</div>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Nombre de Contacto</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_cont" id="ent_cont_editar">
						</div>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="form-control-label">Teléfono de Contacto</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_ctel" id="ent_ctel_editar">
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
		<div class="col-md-12">
			<div class="card border-success-400">
				<div class="card-header bg-dark header-elements-inline">
					<h6 class="card-title">Lista de Proveedores</h6>
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
								<th>RUC</th>
								<th>Razón Social</th>
								<th>Correo</th>
								<th>Dirección</th>
								<th>Ciudad</th>
								<th>Teléfono</th>
								<th>Contacto</th>
								<th>Teléfono de Contacto</th>
								<th>Acciones</th>
							</tr>
						</thead>

					@if(sizeof($entidades)>0)
						

						@foreach ($entidades as $entidad)
							<tr>
								<td>{{$entidad->ent_ruc}}</td>
								<td>{{$entidad->ent_rz}}</td>
								<td>{{$entidad->ent_correo}}</td>
								<td>{{$entidad->ent_dir}}</td>
								<td>{{$entidad->ent_ciu}}</td>
								<td>{{$entidad->ent_tel}}</td>
								<td>{{$entidad->ent_cont}}</td>
								<td>{{$entidad->ent_ctel}}</td>
								<td class="text-center">
									<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
									<div class='dropdown-menu dropdown-menu-right'>
										<a a href="/validado/proveedor/editar?ent_id={{$entidad->ent_id}}" class="btn btn-primary dropdown-item"><i class="icon-reset"></i>Editar</a>

										<a href="/validado/proveedor/eliminar?ent_id={{$entidad->ent_id}}" onclick="return confirm('Esta seguro que desea eliminar?')" class="btn btn-danger dropdown-item"><i class="icon-cancel-square2"></i>Eliminar</a>
									</div>
								</td>
							</tr>
						@endforeach

					@else
						<div class="alert alert-danger">
							<p>Al parecer no tiene Proveedores</p>
						</div>
					@endif

					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
