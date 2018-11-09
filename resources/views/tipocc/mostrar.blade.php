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
	
    var tcc_id = $(btn).attr( "tcc_id" )

    var request = $.ajax({
        url: '/validado/tipocc/editar',
        type: 'GET',
        data: { tcc_id: tcc_id} ,
        contentType: 'application/json; charset=utf-8'
    });

    request.done(function(data) {
    	
        $('#tcc_id_editar').val(data.tcc_id);
        $('#tcc_desc_editar').val(data.tcc_desc);

    });

    request.fail(function(jqXHR, textStatus) {
          alert(textStatus);
    });

}*/
</script>
@endsection

<div id="crearModal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Nuevo Centro de costo</h6>
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

				<form method="post" action="/validado/tipocc/crear">
    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
    				<div class="form-group">
        				<label for="recipient-name" class="form-control-label">Descripción</label>
        				<input type="text" class="form-control" id="recipient-name"  name="tcc_desc">
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
				<h6 class="modal-title">Editar Centro de Costos</h6>
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
                <form method="post" action="/validado/tipocc/editar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" class="form-control" id="tcc_id_editar" name="tcc_id" readonly />
                    <div class="form-group">
                        <label for="tcc_desc" class="form-control-label">Descripcion:</label>
                        <input type="text" class="form-control" id="tcc_desc_editar" name="tcc_desc"/>
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
	<ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="click">
		<li>
			<a class="fab-menu-btn btn bg-teal-400 btn-float rounded-round btn-icon" data-toggle="modal" data-target="#crearModal">
				<i class="fab-icon-open icon-plus3"></i>
				<i class="fab-icon-close icon-plus3"></i>
			</a>
		</li>
	</ul>
	<div class="row">
		<div class="col-md-9 col-centered">
			<div class="card border-success-400">
				<div class="card-header bg-dark header-elements-inline">
					<h6 class="card-title">Lista de Centro de Costos</h6>
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
								<th>Descripción</th>
								<th>Acciones</th>
							</tr>
						</thead>

					@if(sizeof($tipoccs)>0)
						

						@foreach ($tipoccs as $tipocc)
							<tr>
								<td>{{$tipocc->tcc_desc}}</td>
								<td class="text-center">
									<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
									<div class='dropdown-menu dropdown-menu-right'>
										<a href="/validado/tipocc/editar?tcc_id={{$tipocc->tcc_id}}" class="btn btn-primary dropdown-item"><i class="icon-reset"></i>Editar</a>
										<a href="/validado/tipocc/eliminar?tcc_id={{$tipocc->tcc_id}}" onclick="
										return confirm('Esta seguro que desea eliminar?')"
		    							class="btn btn-danger dropdown-item"><i class="icon-cancel-square2"></i>Eliminar</a>
		    						</div>
		    					</td>
							</tr>
						@endforeach

					@else
						<div class="alert alert-danger">
							<p>Al parecer no tiene tipoccs</p>
						</div>
					@endif

					</table>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection
