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
    var conv_id = $(btn).attr( "conv_id" )

    var request = $.ajax({
        url: '/validado/conversion/editar',
        type: 'GET',
        data: { conv_id: conv_id} ,
        contentType: 'application/json; charset=utf-8'
    });

    request.done(function(data) {
        $('#conv_id_editar').val(data.conv_id);
        $('#conv_fact_editar').val(data.conv_fact);

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
				<h6 class="modal-title">Nueva Conversion</h6>
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

				<form method="post" action="/validado/conversion/crear">
    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
    				<div class="form-group">
						<label for="recipient-name" class="form-control-label">Unidad de Medida 1</label>
						<div>
							<select name="um_id1" class="form-control">
								@foreach ($unidadmedidas as $unidadmedida)
								   <option  value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
								@endforeach
							</select>
						</div>
					</div>
    				<div class="form-group">
        				<label for="recipient-name" class="form-control-label">Factor de Conversión</label>
        				<input type="text" class="form-control text-uppercase" id="recipient-name"  name="conv_fact">
    				</div>
    				<div class="form-group">
						<label for="recipient-name" class="form-control-label">Unidad de Medida 2</label>
						<div>
							<select name="um_id2" class="form-control">
								@foreach ($unidadmedidas as $unidadmedida)
								   <option  value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
								@endforeach
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

<div class="modal fade" id="editarModal" tabindex="-1">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Editar Unidad de Conversion</h6>
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
                <form method="post" action="/validado/conversion/editar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="conv_id" id="conv_id_editar">

                    <div class="form-group">
						<label for="recipient-name" class="form-control-label">Unidad de Medida 1</label>
						<div>
							<select name="um_id1" class="form-control">
								@foreach ($unidadmedidas as $unidadmedida)
								   <option  value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
								@endforeach
							</select>
						</div>
					</div>
    				<div class="form-group">
        				<label for="conv_fact" class="form-control-label">Factor de Conversión</label>
        				<input type="text" class="form-control text-uppercase" id="conv_fact_editar"  name="conv_fact">
    				</div>
    				<div class="form-group">
						<label for="recipient-name" class="form-control-label">Unidad de Medida 2</label>
						<div>
							<select name="um_id2" class="form-control">
								@foreach ($unidadmedidas as $unidadmedida)
								   <option  value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
								@endforeach
							</select>
						</div>
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
	<div class="page-header page-header-dark has-cover">
		<div class="page-header-content header-elements-inline">
			<div class="page-title">
				<h5>
					<i class="icon-arrow-left52 mr-2"></i>
					<span class="font-weight-semibold">Conversion</span>
					<small class="d-block opacity-75">SICPA</small>
				</h5>
			</div>

			<div class="header-elements d-flex align-items-center">
                <a class="btn bg-blue btn-labeled btn-labeled-left" href="#" data-toggle="modal" data-target="#crearModal"><b><i class="icon-plus3"></i></b> Crear Conversion</a>
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

@if (Session::has('error'))
	<div class="alert alert-danger">
		<strong>{{Session::get('error')}}</strong>
	</div>
@endif
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
				<div class="card-header bg-teal text-white header-elements-inline">
					<h6 class="card-title">Lista de Conversion</h6>
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
							<th>U. Medida 1</th>
							<th>Factor de Conversión</th>							
							<th>U. Medida 2</th>
							<th>Acciones</th>
						</tr>
					</thead>

				@if(sizeof($conversiones)>0)
					

					@foreach ($conversiones as $conversion)
						<tr>
							<td>{{$conversion->unidadmedida1->um_desc}}</td>
							<td>{{number_format($conversion->conv_fact,2,'.',',')}}</td>
							<td>{{$conversion->unidadmedida2->um_desc}}</td>
							<td><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editarModal" conv_id="{{$conversion->conv_id}}" onclick="setEditarModal(this)">Editar</a>
							<a href="/validado/conversion/eliminar?conv_id={{$conversion->conv_id}}" onclick="
return confirm('Esta seguro que desea eliminar?')"
    class="btn btn-danger">Eliminar</a>
						</tr>
					@endforeach

				@else
					<div class="alert alert-danger">
						<p>Al parecer no tiene conversiones</p>
					</div>
				@endif

				</table>

			</div>
		</div>
	</div>
</div>
@endsection
