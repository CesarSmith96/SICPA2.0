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
					<h6 class="card-title">Caja</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>
			
			<div class="card-body">
				<label>Ventas</label>
				<table class="table table-bordered table-hover table-xs">
						<tr>
							<th width="33%">Total Soles</th>
							<th width="33%">Total Doláres</th>
							<!--<th width="33%">Total</th>-->
						</tr>
						<tr>
							<td style="text-align: right;">S/. {{number_format($tot_ventas_soles,2,'.',',')}}</td>
							<td style="text-align: right;">$. {{number_format($tot_ventas_dolar,2,'.',',')}}</td>
							<!--<td style="text-align: right;">S/. {{number_format($tot_ventas,2,'.',',')}}</td>-->
						</tr>
					
				</table>
			</div>
			
			<div class="card-body">
				<label>Compras</label>
				<table class="table table-bordered table-hover table-xs">
						<tr>
							<th width="33%">Total Soles</th>
							<th width="33%">Total Doláres</th>
							<!--<th width="33%">Total</th>-->
						</tr>
						<tr>
							<td style="text-align: right;">S/. {{number_format($tot_compras_soles,2,'.',',')}}</td>
							<td style="text-align: right;">$. {{number_format($tot_compras_dolar,2,'.',',')}}</td>
							<!--<td style="text-align: right;">S/. {{number_format($tot_compras,2,'.',',')}}</td>-->
						</tr>
					
				</table>
			</div>

			<div class="card-body">
				<label>Gastos</label>
				<table class="table table-bordered table-hover table-xs">
						<tr>
							<th width="33%">Total Soles</th>
							<th width="33%">Total Doláres</th>
							<!--<th width="33%">Total</th>-->
						</tr>
						<tr>
							<td style="text-align: right;">S/. {{number_format($tot_egresos_soles,2,'.',',')}}</td>
							<td style="text-align: right;">$. {{number_format($tot_egresos_dolar,2,'.',',')}}</td>
							<!--<td style="text-align: right;">S/. {{number_format($tot_egresos,2,'.',',')}}</td>-->
						</tr>
					
				</table>
			</div>

			<div class="card-body">
				<label>TOTAL BRUTO</label>
				<table class="table table-bordered table-hover table-xs">
						<!--<tr>
							<th width="33%">TOTAL BRUTO</th>
							<th width="33%">S/. {{number_format($total,2,'.',',')}}</th>
						</tr>-->	
						<tr>
							<th width="33%" style="text-align: right;">S/. {{number_format(($tot_ventas_soles-$tot_compras_soles-$tot_egresos_soles),2,'.',',')}}</th>
							<th width="33%" style="text-align: right;">$. {{number_format(($tot_ventas_dolar-$tot_compras_dolar-$tot_egresos_dolar),2,'.',',')}}</th>
							<!--<th width="33%" style="text-align: right;">S/. {{number_format(($tot_ventas-$tot_compras-$tot_egresos),2,'.',',')}}
						</th>-->
						</tr>				
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
