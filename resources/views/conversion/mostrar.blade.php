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
	
function printDiv(nombreDiv) {
 var contenido= document.getElementById(nombreDiv).innerHTML;
 var contenidoOriginal= document.body.innerHTML;

 document.body.innerHTML = contenido;

 window.print();

 document.body.innerHTML = contenidoOriginal;
}
</script>
<script src="{{asset('global_assets/js/plugins/cliente/datatable_cliente.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script type="text/javascript">

$( document ).ready(function() {
	@if (count($errors) > 0)
    	$('#crearModal').modal('show');
	@endif
});


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
					<h6 class="card-title">Lista de Conversiones</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collaspse"></a>
	                	</div>
	            	</div>
				</div>
				<div class="card-body" id="areaImprimir">
					<table class="table table-bordered table-hover datatable-basic table-xs">
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
								<td class="text-center">
									<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
									<div class='dropdown-menu dropdown-menu-right'>
										<a href="/validado/conversion/editar?conv_id={{$conversion->conv_id}}" class="btn btn-primary dropdown-item"><i class="icon-reset"></i>Editar</a>
										<a href="/validado/conversion/eliminar?conv_id={{$conversion->conv_id}}" onclick="
										return confirm('Esta seguro que desea eliminar?')"
		    							class="btn btn-danger dropdown-item"><i class="icon-cancel-square2"></i>Eliminar</a>
		    						</div>
		    					</td>
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
</div>
@endsection
