@extends('plantillas.headeradmin')
@section('javascript')
<script type="text/javascript">
</script>
<script src="{{asset('global_assets/js/plugins/cliente/datatable_cliente.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>

<script type="text/javascript">

$( document ).ready(function() {
	@if (count($errors) > 0)
    	$('#editarModal').modal('show');
	@endif
});

$( document ).ready(function() {
	@if (count($errors) > 0)
    	$('#crearModal').modal('show');
	@endif
});

function setEditarModal(btn){
    var alm_id = $(btn).attr( "alm_id" )

    var request = $.ajax({
        url: '/validado/almacen/editar',
        type: 'GET',
        data: { alm_id: alm_id} ,
        contentType: 'application/json; charset=utf-8'
    });

    request.done(function(data) {
        $('#alm_id_editar').val(data.alm_id);
        $('#alm_desc_editar').val(data.alm_desc);

    });

    request.fail(function(jqXHR, textStatus) {
          alert(textStatus);
    });

}

</script>

@endsection
@section('content')

<div id="crearModal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Nuevo Almacen</h6>
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

				<form method="post" action="/validado/almacen/crear">
    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
    				<div class="form-group">
        				<label for="recipient-name" class="form-control-label">Descripción</label>
        				<input type="text" class="form-control" id="recipient-name"  name="alm_desc">
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

<div class="modal fade" id="editarModal" tabindex="-1">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Editar Almacen</h6>
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
                <form method="post" action="/validado/almacen/editar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="alm_id" class="form-control-label">Id del Almacen:</label>
                        <input type="text" class="form-control" id="alm_id_editar" name="alm_id" readonly />
                    </div>

                    <div class="form-group">
                        <label for="alm_desc" class="form-control-label">Descripcion:</label>
                        <input type="text" class="form-control" id="alm_desc_editar" name="alm_desc"/>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn bg-success">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div>
	<div class="page-header bg-success">
		<div class="page-header-content header-elements-inline">
			<div class="page-title">
				<h5>
					<i class="icon-arrow-left52 mr-2"></i>
					<span class="font-weight-semibold">Almacenes</span>
					<small class="d-block opacity-75">SICPA</small>
				</h5>
			</div>

			<div class="header-elements d-flex align-items-center">
                <a class="btn bg-blue btn-labeled btn-labeled-left" href="#" data-toggle="modal" data-target="#crearModal" data-whatever="@getbootstrap"><b><i class="icon-plus3"></i></b> Crear Almacen</a>
			</div>
		</div>

		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
					<a href="components_page_header.html" class="breadcrumb-item">Current</a>
					<span class="breadcrumb-item active">Location</span>
				</div>

				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>

			<div class="header-elements d-none">
				<div class="breadcrumb justify-content-center">
					<a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
						Actions
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
						<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
						<a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

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
	<div class="row">
		<div class="col-md-9 col-centered">
			<div class="card border-success-400">

				<div class="card-header bg-success text-white header-elements-inline">
					<h6 class="card-title">Lista de Almacenes</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="reload"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>

				<table class="table datatable-basic">
					<thead>
						<tr>
							<th>Código</th>
							<th>Descripción</th>
							<th>Acciones</th>
						</tr>
					</thead>


				@if(sizeof($almacenes)>0)

					@foreach ($almacenes as $almacen)
						<tr>
							<td>{{$almacen->alm_id}}</td>
							<td>{{$almacen->alm_desc}}</td>

							<td>
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editarModal" alm_id="{{$almacen->alm_id}}" onclick="setEditarModal(this)"><i class="icon-reset"></i></a>
								
							<a href="/validado/almacen/eliminar?alm_id={{$almacen->alm_id}}" onclick="
							return confirm('Esta seguro que desea eliminar?')"
   							class="btn btn-danger"><i class="icon-cancel-square2"></i></a>
						</tr>
					@endforeach

				@else
					<div class="alert alert-danger">
						<p>Al parecer no tiene almacenes</p>
					</div>
				@endif

				</table>

			</div>
		</div>
	</div>
</div>
@endsection
