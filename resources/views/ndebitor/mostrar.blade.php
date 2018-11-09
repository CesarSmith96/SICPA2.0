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
<style>
    	#hh { font-size: 16px; color: #1e1f19; background-color: #f3f3f3; padding: 10px 20px; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; }
    #hh { color: #7A7A78; }
    #intro { margin-bottom: 0px; }
    #intro:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }

    #intro .zelect {
      display: inline-block;
      background-color: white;
      min-width: 300px;
      cursor: pointer;
      line-height: 32px;
      border: 1px solid #D0D0D0;
      border-radius: 6px;
      position: relative;
    }
    #intro .zelected {
      padding-left: 10px;
    }
    #intro .zelected.placeholder {
      color: #67737A;
    }
    #intro .zelected:hover {
      border-color: #99B8BF;
      box-shadow: inset 0px 5px 8px -6px #D0D0D0;
    }
    #intro .zelect.open {
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }
    #intro .dropdown {
      background-color: white;
      border-bottom-left-radius: 5px;
      border-bottom-right-radius: 5px;
      border: 1px solid #D0D0D0;
      border-top: none;
      position: absolute;
      left:-1px;
      right:-1px;
      top: 36px;
      z-index: 2;
      padding: 3px 5px 3px 3px;
    }
    #intro .dropdown input {
      font-family: sans-serif;
      outline: none;
      font-size: 14px;
      border-radius: 4px;
      border: 1px solid #D0D0D0;
      box-sizing: border-box;
      width: 100%;
      padding: 7px 0 7px 10px;
    }
    #intro .dropdown ol {
      padding: 0;
      margin: 3px 0 0 0;
      list-style-type: none;
      max-height: 150px;
      overflow-y: scroll;
    }
    #intro .dropdown li {
      padding-left: 10px;
    }
    #intro .dropdown li.current {
      background-color: #AFB6B7;
    }
    #intro .dropdown .no-results {
      margin-left: 10px;
    }
</style>
@endsection
@section('javascript')
<script type="text/javascript">
</script>
<script src="{{asset('global_assets/js/plugins/cliente/datatable_cliente.js')}}"></script>
<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>

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

	<div class="col-md-9 col-centered">
		<div class="card border-success-400">
			<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Notas de Debito Recibidas</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                		<a class="list-icons-item" data-action="remove"></a>
	                	</div>
	            	</div>
				</div>

			<div class="card-body border-success-400">

				<table class="table table-bordered table-hover datatable-basic table-xs">
					<thead>
						<tr>
							<th>Nro.</th>
							<th>Tipo</th>
							<th>Cliente</th>
							<th>Fecha</th>
							<th>Estado</th>
							<th>Condicion</th>
							<th>Monto</th>
							<th>Moneda</th>
							<th>Tipo de Cambio</th>	
							<th width="230">Acciones</th>	
						</tr>
					</thead>

				@if(sizeof($comprobantes)>0)
					

					@foreach ($comprobantes as $comprobante)
						<tr>
							<td>{{$comprobante->comp_nro}}</td>
							<td>{{$comprobante->tipocomprobanteinc->tcompinc_desc}}</td>
							<td>{{$comprobante->entidad->ent_rz}}</td>
							<td>{{date('d/m/Y', strtotime($comprobante->comp_fecha))}}</td>
							<td>{{$comprobante->comp_est}}</td>
							<td>{{$comprobante->comp_cond}}</td>
							<td>{{$comprobante->comp_tot}}</td>
							<td>{{$comprobante->comp_moneda}}</td>
							<td>{{$comprobante->comp_tipcambio}}</td>
							<td class="text-center">
								<a href='#' class='text-default dropdown-toggle' data-toggle='dropdown'><i class='icon-menu7'></i></a>
								<div class='dropdown-menu dropdown-menu-right'>
									<a href="/validado/detallenotacreditorecibida?comp_id={{$comprobante->comp_id}}"><img src="/images/detalle.png"  title="VER DETALLE"></a>
									<a href="/validado/ndebito/editar?comp_id={{$comprobante->comp_id}}"><img src="/images/editar.png" title="EDITAR"></a>
									<a href="/validado/ndebito/eliminar?comp_id={{$comprobante->comp_id}}" onclick="return confirm('Esta seguro que desea eliminar?')"><img src="/images/eliminar.png" title="ELIMINAR"></a>
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
