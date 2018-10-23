@extends('plantillas.headeradmin')
@section('javascript')
<script type="text/javascript">
</script>
<script src="{{asset('global_assets/js/plugins/cliente/datatable_cliente.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
@endsection
@section('content')

@if (Session::has('error'))
	<div class="alert alert-danger">
		<strong>Whoops!</strong> Al parecer algo está mal.<br><br>
		{{Session::get('error')}}
	</div>
@endif
<div class="content">
	<div class="row">
		<div class="col-md-8 col-centered">
			<div class="card border-success">
				<div class="card-header bg-success text-white header-elements-inline">
					<h6 class="card-title">Bienvenido {{Auth::user()->usu_nom}}</h6>
				</div>
				<div class="card-body">

					<img src="/images/logo.jpg"/>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
