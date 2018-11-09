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

function printDiv(nombreDiv) {
 var contenido= document.getElementById(nombreDiv).innerHTML;
 var contenidoOriginal= document.body.innerHTML;

 document.body.innerHTML = contenido;

 window.print();

 document.body.innerHTML = contenidoOriginal;
}

$( document ).ready(function() {
	@if (count($errors) > 0)
    	$('#crearModal').modal('show');
	@endif
});

/*function setEditarModal(btn){

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

}*/
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

<!--<div class="modal fade" id="editarModal" tabindex="-1">
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
                        <input type="hidden" class="form-control" id="alm_id_editar" name="alm_id" readonly />
                    <div class="form-group">
                        <label for="alm_desc" class="form-control-label">Descripcion:</label>
                        <input type="text" class="form-control" id="alm_desc_editar" name="alm_desc"/>
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
		<div class="col-md-9 col-centered">
			<div class="card border-success-400">

				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Lista de Almacenes</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
	            	</div>
				</div>
				<div class="card-body border-success-400">
					
						<table class="table table-bordered table-hover datatable-basic table-xs" id="areaImprimir">
							<thead>
								<tr>
									<th>Código</th>
									<th>Descripción</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								@if(sizeof($almacenes)>0)
								@foreach ($almacenes as $almacen)
									<tr>
										<td>{{$almacen->alm_id}}</td>
										<td>{{$almacen->alm_desc}}</td>

										<td class="text-center">
											<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
												<div class='dropdown-menu dropdown-menu-right'>
													<a href="/validado/almacen/editar?alm_id={{$almacen->alm_id}}" class="btn btn-primary dropdown-item"><i class="icon-reset"></i> Editar</a>
													<a href="/validado/almacen/eliminar?alm_id={{$almacen->alm_id}}" onclick="
													return confirm('Esta seguro que desea eliminar?')"
				   									class="btn btn-danger dropdown-item"><i class="icon-cancel-square2"></i>Eliminar</a>
			   									</div>
			   							</td>
									</tr>
								@endforeach
							</tbody>
							

							@else
							<tbody>
								<div class="alert alert-danger">
									<p>Al parecer no tiene almacenes</p>
								</div>
							</tbody>
							@endif
						</table>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
