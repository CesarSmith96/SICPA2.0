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



$(document).ready(function () {
  	$('#ent_ruc').keyup(function () {
     	var ent_ruc = $('#ent_ruc').val();

        if (ent_ruc.length!=8 && ent_ruc.length!=11) 
        {
        	$('#label').val("ingrese correcto");
        }
        else
        {
        	$.get('{{ url('information') }}/create/ajax-state-vercliente?ent_ruc=' + ent_ruc, function(data) {
                $('#label').val(data);
        	});
        }
  	});
});

function setEditarModal(btn){
 	
var ent_id = $(btn).attr( "ent_id" )

var request = $.ajax({
    url: '/validado/cliente/editar',
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
    $('#ent_dpto_editar').val(data.ent_dpto);
    $('#ent_ciu_editar').val(data.ent_ciu);
    $('#ent_tel_editar').val(data.ent_tel);
    $('#ent_cont_editar').val(data.ent_cont);
    $('#ent_ctel_editar').val(data.ent_ctel);

});

request.fail(function(jqXHR, textStatus) {
      alert(textStatus);
    });

}
</script>

<script src="{{asset('global_assets/js/plugins/cliente/datatable_cliente.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
@endsection
@section('content')

<div id="crearModal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Nuevo Cliente</h6>
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

				<form class="form-horizontal" role="form" method="POST" action="/validado/cliente/crear">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">RUC ó DNI</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_ruc" id="ent_ruc" value="{{ old('ent_ruc') }}">
									</div>
									<input type="text" id="label" style="border-width:0;font-size: 15px; color:red" readonly="readonly">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Razón Social</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_rz" value="{{ old('ent_rz') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Correo</label>
									<div>
										<input type="text" class="form-control" name="ent_correo" value="{{ old('ent_correo') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Dirección</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_dir" value="{{ old('ent_dir') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Departamento</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_dpto" value="{{ old('ent_dpto') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Ciudad</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_ciu" value="{{ old('ent_ciu') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Teléfono</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_tel" value="{{ old('ent_tel') }}">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nombre de Contacto</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="ent_cont" value="{{ old('ent_cont') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Teléfono de Contacto</label>
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

<div class="modal fade" id="editarModal" tabindex="-1">
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-success">
				<h6 class="modal-title">Editar Cliente</h6>
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
                <form class="form-horizontal" role="form" method="POST" action="/validado/cliente/editar">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="ent_id" id="ent_id_editar" readonly="" >
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">RUC ó DNI</label>
								<div>
									<input type="text" class="form-control text-uppercase" name="ent_ruc" id="ent_ruc_editar">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Razón Social</label>
								<div>
									<input type="text" class="form-control text-uppercase" name="ent_rz" id="ent_rz_editar">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Correo</label>
								<div>
									<input type="text" class="form-control" name="ent_correo" id="ent_correo_editar">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Dirección</label>
								<div>
									<input type="text" class="form-control text-uppercase" name="ent_dir" id="ent_dir_editar">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Departamento</label>
								<div>
									<input type="text" class="form-control text-uppercase" name="ent_dpto" id="ent_dpto_editar">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Ciudad</label>
								<div>
									<input type="text" class="form-control text-uppercase" name="ent_ciu" id="ent_ciu_editar">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Teléfono</label>
								<div>
									<input type="text" class="form-control text-uppercase" name="ent_tel" id="ent_tel_editar">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nombre de Contacto</label>
								<div>
									<input type="text" class="form-control text-uppercase" name="ent_cont" id="ent_cont_editar">
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Teléfono de Contacto</label>
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
						<form class="form-inline" role="form" method="POST" action="/validado/cliente">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" name="imprimir" value="imprimir" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
							<i class="icon-printer2"></i> 
						</button>
						</form>
					</div>
				</li>
			</ul>
		</li>
	</ul>
	<!--<ul class="fab-menu fab-menu-absolute fab-menu-top-right" data-fab-toggle="hover" id="fab-menu-affixed-demo-right">
		<li>
			<a class="fab-menu-btn btn bg-pink-300 btn-float rounded-round btn-icon">
				<i class="fab-icon-open icon-grid3"></i>
				<i class="fab-icon-close icon-cross2"></i>
			</a>

			<ul class="fab-menu-inner">
				<li>
					<div data-fab-label="Compose email">
						<a href="#" class="btn btn-light rounded-round btn-icon btn-float">
							<i class="icon-pencil"></i>
						</a>
					</div>
				</li>
				<li>
					<div data-fab-label="Conversations">
						<a href="#" class="btn btn-light rounded-round btn-icon btn-float">
							<i class="icon-bubbles3"></i>
						</a>
						<span class="badge bg-primary-400">5</span>
					</div>
				</li>
				<li>
					<div data-fab-label="Chat with Jack">
						<a href="#" class="btn bg-pink-400 rounded-round btn-icon btn-float">
							<img src="../../../../global_assets/images/demo/users/face23.jpg" class="img-fluid rounded-circle" alt="">
						</a>
						<span class="badge badge-mark border-pink-400"></span>
					</div>
				</li>
			</ul>
		</li>
	</ul>-->
	<div class="row">
		<div class="col-md-12 col-centered">
			<div class="card border-success-400">
				<div class="card-header bg-dark header-elements-inline">
					<h6 class="card-title">Lista de Clientes</h6>
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
							<th>RUC ó DNI</th>
							<th>Razón Social</th>
							<th>Correo</th>
							<th>Dirección</th>
							<th>Departamento</th>
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
								<td>{{strtoupper($entidad->ent_ruc)}}</td>
								<td>{{strtoupper($entidad->ent_rz)}}</td>
								<td>{{$entidad->ent_correo}}</td>
								<td>{{strtoupper($entidad->ent_dir)}}</td>
								<td>{{strtoupper($entidad->ent_dpto)}}</td>
								<td>{{strtoupper($entidad->ent_ciu)}}</td>
								<td>{{strtoupper($entidad->ent_tel)}}</td>
								<td>{{strtoupper($entidad->ent_cont)}}</td>
								<td>{{strtoupper($entidad->ent_ctel)}}</td>
								<td class="text-center">
									<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
									<div class='dropdown-menu dropdown-menu-right'>
										<a href="#" class="btn btn-primary dropdown-item" data-toggle="modal" data-target="#editarModal" ent_id="{{$entidad->ent_id}}" onclick="setEditarModal(this)"><i class="icon-reset"></i>Editar</a>
										<a href="/validado/cliente/eliminar?ent_id={{$entidad->ent_id}}" onclick="return confirm('Esta seguro que desea eliminar?')" class="btn btn-danger dropdown-item"><i class="icon-cancel-square2"></i>Eliminar</a>
									</div>
								</td>
							</tr>
						@endforeach

					@else
						<div class="alert alert-danger">
							<p>Al parecer no tiene clientes</p>
						</div>
					@endif

					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-centered">
			<div class="card border-success-400">
				<div class="card-header bg-dark header-elements-inline">
					<h6 class="card-title">Busqueda</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="reload"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>

			<div class="card-body">
				
				<form class="form-inline" role="form" method="POST" action="/validado/cliente">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="col-md-offset-0">
						<button type="submit" name="imprimir" value="imprimir" class="btn btn-default">
							<img src="/images/imprimir.png" title="imprimir">
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>

</div>
@endsection
