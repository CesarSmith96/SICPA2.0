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
<div class="content">
	<div class="col-md-9 col-centered">
		<div class="card border-success-400">
			<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Notas de Credito</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>

			<div class="card-body">
				<table class="table table-bordered table-hover datatable-basic table-xs">
					<thead>
						<tr>
							<th>Nro. Nota de Crédito</th>
							<th>Comprobante</th>
							<th>Total</th>
							<th>Observaciones</th>
						</tr>
					</thead>

				@if(sizeof($notacreditos)>0)
					

					@foreach ($notacreditos as $notacredito)
						<tr>
							<td>{{$notacredito->ncred_num}}</td>
							<td>{{$notacredito->comprobante->comp_nro}}</td>
							<td>{{number_format($notacredito->ncred_tot,2,'.',',')}}</td>
							<td>{{$notacredito->ncred_obs}}</td>
						</tr>
					@endforeach

				@else
					<div class="alert alert-danger">
						<p>Al parecer no tiene Notas de credito</p>
					</div>
				@endif

				</table>

			</div>
		</div>
	</div>
</div>
@endsection
