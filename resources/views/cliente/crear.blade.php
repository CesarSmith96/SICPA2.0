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
</script>
@endsection
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-7 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Nuevo Cliente</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
	            	</div>
				</div>
				<div class="card-body">
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

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Crear
								</button>
								<a href="/validado/cliente" class="btn btn-danger" role="button">Cancelar</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
