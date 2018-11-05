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
		$('#crearModal').modal('show');
	@endif
});

function getUp(sel)
{	    
    var prod_id = sel.value;

    $.get('{{ url('information') }}/create/ajax-state-prod_um?prod_id=' + prod_id, function(data) {
            $('#um_id').val(data.um_id);
            $('#um_desc').val(data.um_desc);
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
				<h6 class="modal-title">Nuevo Inventario</h6>
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

				<form class="form-horizontal" role="form" method="POST" action="/validado/inventario/crear">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<input type="hidden" name="um_id" id="um_id" readonly="">
						<label class="control-label">Producto</label>
						<div>
							<select name="prod_id" class="form-control text-uppercase" onchange="getUp(this)">
								<option  value='0'>Elija Producto</option>
								@foreach ($productos as $producto)
								   <option  value='{{$producto->prod_id}}'>{{$producto->prod_desc}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Cantidad</label>
						<div>
							<input type="text" class="form-control text-uppercase" id="inv_cant" name="inv_cant">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Unidad de Medida</label>
						<div>
							<input type="text" disabled class="form-control text-uppercase" id="um_desc" name="um_desc">
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
						<a href="#" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400" data-toggle="modal" data-target="#crearModal">
							<i class="icon-plus3"></i>
						</a>
					</div>
				</li>
				<li>
					<div data-fab-label="Imprimir">
						<form class="form-inline" role="form" method="POST" action="/validado/inventario">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" name="imprimirinv" value="imprimirinv" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
							<i class="icon-printer2"></i> 
						</button>
						</form>
					</div>
				</li>
			</ul>
		</li>
	</ul>
	<div class="row">
		<div class="col-md-9 col-centered">
			<div class="card border-success-400">

				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Lista de Inventario</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>
				<a href="/validado/inventario/actualizar" class="btn btn-success" role="button">Actualizar</a>
				<div class="card-body">
					<table class="table table-bordered table-hover datatable-basic table-xs">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Unidad</th>
								<th>Última actualización</th>						
								<th>Acciones</th>						
							</tr>
						</thead>

					@if(sizeof($inventarios)>0)
						

						@foreach ($inventarios as $inventario)
							<tr class="text-center">
								<td>{{$inventario->producto->prod_desc}}</td>
								<td style="text-align:right;">{{$inventario->inv_cant}}</td>
								<td>{{$inventario->producto->unidadmedida->um_desc}}</td>
								<td>{{date('d/m/Y', strtotime($inventario->inv_fecha))}}</td>
								<td>
									<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
									<div class='dropdown-menu dropdown-menu-right'>
										<a href="/validado/inventario/editar?inv_id={{$inventario->inv_id}}" class="btn btn-primary dropdown-item" role="button"><i class="icon-reset"></i>Editar</a>
									</div>
								</td>
							</tr>
						@endforeach

					@else
						<div class="alert alert-danger">
							<p>Al parecer no tiene inventarios</p>
						</div>
					@endif

					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
