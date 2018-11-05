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
	function imprimir(){
	  var objeto=document.getElementById('imprimir');  //obtenemos el objeto a imprimir
	  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
	  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
	  ventana.document.close();  //cerramos el documento
	  ventana.print();  //imprimimos la ventana
	  ventana.close();  //cerramos la ventana
	}
</script> 
<script type="text/javascript">
	$(setup)
	function setup() {
	    $('#intro select').zelect({ placeholder:'Selecciona Cliente...' })
	}
</script>
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

	<ul class="fab-menu fab-menu-fixed fab-menu-bottom-right" data-fab-toggle="hover" id="fab-menu-affixed-demo-right">
		<li>
			<a class="fab-menu-btn btn bg-teal-400 btn-float rounded-round btn-icon">
				<i class="fab-icon-open icon-paragraph-justify3"></i>
				<i class="fab-icon-close icon-cross2"></i>
			</a>

			<ul class="fab-menu-inner">
				<li>
					<div data-fab-label="Agregar">
						<a href="/validado/npedido/crear" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
							<i class="icon-plus3"></i>
						</a>
					</div>
				</li>
				<li>
					<div data-fab-label="Imprimir">
						<form class="form-inline" role="form" method="POST" action="/validado/npedido">
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

	<div class="col-md-10 col-centered">
		<div class="card border-success-400">
			<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Nota de Pedido</h6>
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
							<th>Nro.</th>
							<th>Cliente</th>
							<th>Fecha</th>
							<th>Subtotal</th>
							<th>IGV</th>
							<th>Total</th>
							<th>Saldo</th>
							<th>Estado</th>
							<th>Moneda</th>
							<th>Tipo de Cambio</th>	
							<th width="230">Acciones</th>	
						</tr>
					</thead>

				@if(sizeof($ordencvs)>0)
					

					@foreach ($ordencvs as $ordencv)
						<tr>
							<td>{{$ordencv->ocv_nro}}</td>
							<td>{{$ordencv->entidad->ent_rz}}</td>
							<td>{{date('d/m/Y', strtotime($ordencv->ocv_fecha))}}</td>
							<td>{{number_format($ordencv->ocv_subt,2,'.',',')}}</td>
							<td>{{number_format($ordencv->ocv_igv,2,'.',',')}}</td>
							<td>{{number_format($ordencv->ocv_tot,2,'.',',')}}</td>
							<td>{{number_format($ordencv->ocv_saldo,2,'.',',')}}</td>
							<td>{{$ordencv->ocv_est}}</td>
							<td>{{$ordencv->ocv_moneda}}</td>
							<td>{{$ordencv->ocv_tipcambio}}</td> 
							<td class="text-center">
								<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
								<div class='dropdown-menu dropdown-menu-right'>
									<a class="btn btn-primary dropdown-item" href="/validado/detallenpedido?ocv_id={{$ordencv->ocv_id}}"><img src="/images/detalle.png" title="VER DETALLE">VER DETALLE</a>
									<a class="btn btn-primary dropdown-item" href="/validado/npedido/editar?ocv_id={{$ordencv->ocv_id}}"><img src="/images/editar.png" title="EDITAR">EDITAR</a>
									<a class="btn btn-primary dropdown-item" href="/validado/npedido/eliminar?ocv_id={{$ordencv->ocv_id}}" onclick="return confirm('Esta seguro que desea eliminar?')"><img src="/images/eliminar.png" title="ELIMINAR">ELIMINAR</a>
									
									@if($ordencv->ocv_doc!='')
										<a class="btn btn-primary dropdown-item" target="_blank" href="/img/{{$ordencv->ocv_doc}}"><img src="/images/pdf.png" title="VER ARCHIVO">VER ARCHIVO</a>
									@endif
									@if($ordencv->ocv_est=='ACTIVO')
										<a class="btn btn-primary dropdown-item" href="/validado/npedido/asignar?ocv_id={{$ordencv->ocv_id}}"><img src="/images/asignar.png" title="ASIGNAR COMPROBANTE">ASIGNAR COMPROBANTE</a>
									@endif
								</div>
							</td>

						</tr>
					@endforeach

				@else
					<div class="alert alert-danger">
						<p>Al parecer no tiene Nota de Pedidos</p>
					</div>
				@endif

				</table>

			</div>
		</div>
	</div>
</div>
@endsection
