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

<script>
    function getUp(sel)
	{	    
	    var prod_id = sel.value;

        $.get('{{ url('information') }}/create/ajax-state-prod_um?prod_id=' + prod_id, 
        	function(data) {
        		alert(data)
                $('#um_id').val(data.um_id);
                $('#um_desc').val(data.um_desc);
        });

	}
</script>
@endsection
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-9 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Nueva Registro de Inventario</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
	            	</div>
				</div>
				<div class="card-body border-success-400">
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

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Crear
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
