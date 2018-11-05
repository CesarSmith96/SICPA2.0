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
						<a href="/validado/ingreso/crear" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
							<i class="icon-plus3"></i>
						</a>
					</div>
				</li>
				<li>
					<div data-fab-label="Exportar">
						<form class="form-inline" role="form" method="POST" action="/validado/ingreso">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<button type="submit" name="exportarxls" value="imprimir" class="btn btn-light rounded-round btn-icon btn-float bg-teal-400">
							<i class="icon-printer2"></i> 
						</button>
						</form>
					</div>
				</li>
			</ul>
		</li>
	</ul>

	<div class="col-md-12 col-centered">
		<div class="card border-success-400">

			<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Compras</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>

			<div class="card-body">
				<table class="table table-bordered table-hover datatable-basic table-xs" style="font-size: 11px">
					<thead>
						<tr>
							<th>Nro.</th>
							<th>Tipo</th>
							<th>Proveedor</th>
							<th>Fecha</th>
							<th>Guía</th>
							<th><div style="display:inline; float:right">Subtotal</div></th>
							<th><div style="display:inline; float:right">IGV</div></th>
							<th><div style="display:inline; float:right">Total</div></th>
							<th><div style="display:inline; float:right">Saldo</div></th>
							<th>Estado</th>
							<th>Condición</th>
							<th>Moneda</th>
							<th>T. Cambio</th>	
							<th width="230">Acciones</th>	
						</tr>
					</thead>

				@if(sizeof($comprobantes)>0)
					

					@foreach ($comprobantes as $comprobante)
						<tr>
							<td>{{$comprobante->comp_nro}}</td>
							@if($comprobante->tipocomprobante->tcomp_desc=="Boleta")
								<td>BV</td>
							@else
								<td>FAC</td>
							@endif
							<td>{{$comprobante->entidad->ent_rz}}</td>
							<td>{{date('d/m/Y', strtotime($comprobante->comp_fecha))}}</td>
							<td>{{$comprobante->comp_guia}}</td>
							<td><div style="display:inline; float:right">{{number_format($comprobante->comp_subt,2,'.',',')}}</div></td>
							<td><div style="display:inline; float:right">{{number_format($comprobante->comp_igv,2,'.',',')}}</div></td>
							<td><div style="display:inline; float:right">{{number_format($comprobante->comp_tot,2,'.',',')}}</div></td>
							<td><div style="display:inline; float:right">{{number_format($comprobante->comp_saldo,2,'.',',')}}</div></td>
							<td>{{$comprobante->comp_est}}</td>
							<td>{{$comprobante->comp_cond}}</td>
							<td>{{$comprobante->comp_moneda}}</td>
							<td>{{$comprobante->comp_tipcambio}}</td> 
							<td class="text-center">
								<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
								<div class='dropdown-menu dropdown-menu-right'>
									<a class="btn btn-primary dropdown-item" ="/validado/detalleingreso?comp_id={{$comprobante->comp_id}}"><img src="/images/detalle.png" title="VER DETALLE">VER DETALLE</a>
									<a class="btn btn-primary dropdown-item" href="/validado/ingreso/editar?comp_id={{$comprobante->comp_id}}"><img src="/images/editar.png" title="EDITAR">EDITAR</a>
									<a class="btn btn-primary dropdown-item" href="/validado/ingreso/eliminar?comp_id={{$comprobante->comp_id}}" onclick="return confirm('Esta seguro que desea eliminar?')"><img src="/images/eliminar.png" title="ELIMINAR">ELIMINAR</a>

									@if($comprobante->comp_doc!='')
										<a target="_blank" class="btn btn-primary dropdown-item" href="/img/{{$comprobante->comp_doc}}"><img src="/images/pdf.png" title="VER ARCHIVO">VER ARCHIVO</a>
									@endif
									@if($comprobante->comp_est!='ANULADO')
										<a class="btn btn-primary dropdown-item" href="/validado/ingreso/sanular?comp_id={{$comprobante->comp_id}}" onclick="return confirm('Esta seguro que desea anular?')"><img src="/images/anular.png" title="ANULAR">ANULAR</a>
										<a class="btn btn-primary dropdown-item" href="/validado/ndebito/crear?comp_id={{$comprobante->comp_id}}""><img src="/images/ncredito.png" title="NOTA DE DÉBITO">NOTA DE DÉBITO</a>
										<!--<a href="/validado/notacredito/crear?comp_id={{$comprobante->comp_id}}" onclick="return confirm('Esta seguro que desea anular con NOTA DE CRÉDITO?')"><img src="/images/ncredito.png" title="ANULAR CON NOTA DE CRÉDITO"></a>
										<a href="/validado/notacredito/seleccionar?comp_id={{$comprobante->comp_id}}"><img src="/images/asignarnc.png" title="PAGAR CON NOTA DE CRÉDITO"></a>-->
									@endif
								</div>
							</td>

						</tr>
					@endforeach

				@else
					<div class="alert alert-danger">
						<p>Al parecer no tiene comprobantes</p>
					</div>
				@endif

				</table>

			</div>
		</div>
	</div>
</div>
@endsection
