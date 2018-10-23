@extends('plantillas.headeradmin')
@section('javascript')
<script type="text/javascript">
</script>
<script src="{{asset('global_assets/js/plugins/cliente/datatable_cliente.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
@endsection
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

<div>
	<div class="page-header page-header-dark has-cover">
		<div class="page-header-content header-elements-inline">
			<div class="page-title">
				<h5>
					<i class="icon-arrow-left52 mr-2"></i>
					<span class="font-weight-semibold">CLIENTES</span>
					<small class="d-block opacity-75">SICPA</small>
				</h5>
			</div>

			<div class="header-elements d-flex align-items-center">
                <a class="btn bg-success btn-labeled btn-labeled-left" href="#" data-toggle="modal" data-target="#crearModal"><b><i class="icon-plus3"></i></b> Crear Cliente</a>
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


<div class="content">
	<div class="row">
		<div class="col-md-12 col-centered">
			<div class="card border-success-400">
				<div class="card-header bg-success text-white header-elements-inline">
					<h6 class="card-title">Lista de Clientes</h6>
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
							<td><a href="/validado/cliente/editar?ent_id={{$entidad->ent_id}}" class="btn btn-primary" role="button">Editar</a>
							<a href="/validado/cliente/eliminar?ent_id={{$entidad->ent_id}}" onclick="return confirm('Esta seguro que desea eliminar?')" class="btn btn-danger">Eliminar</a>
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

	<div class="row">
		<div class="col-md-12 col-centered">
			<div class="card border-success-400">
				<div class="card-header bg-success text-white header-elements-inline">
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
					
					<div class="form-group col-md-offset-0">
						<label>RUC ó DNI</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_ruc">
						</div>
					</div>
					<div class="form-group col-md-offset-0">
						<label>Razón Social</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_rz">
						</div>
					</div>
					<div class="form-group col-md-offset-0">
						<label>Dirección</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_dir">
						</div>
					</div>
					<div class="form-group col-md-offset-0">
						<label>Departamento</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_dpto">
						</div>
					</div>
					<div class="form-group col-md-offset-0">
						<label>Ciudad</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_ciu">
						</div>
					</div>
					<div class="form-group col-md-offset-0">
						<label>Contacto</label>
						<div>
							<input type="text" class="form-control text-uppercase" name="ent_cont">
						</div>
					</div>
					<div class="col-md-offset-0">
						</br>
						<button type="submit" name="buscar" value="buscar" class="btn btn-default">
							<img src="/images/buscar.png" title="BsUSCAR">
						</button>
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
