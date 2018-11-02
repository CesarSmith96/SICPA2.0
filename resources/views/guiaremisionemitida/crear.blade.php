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
          	$('#comp_nro').keyup(function () {
             	var comp_nro = $('#comp_nro').val();

		        $.get('{{ url('information') }}/create/ajax-state-vercomps?comp_nro=' + comp_nro, function(data) {
		                $('#label').val(data);
		        });
          	});
			
      });
</script>
<script type="text/javascript">
      $(document).ready(function () {
          	$('#comp_ref').keyup(function () {
             	var comp_ref = $('#comp_ref').val();

		        $.get('{{ url('information') }}/create/ajax-state-vercomprobante?comp_ref=' + comp_ref, function(data) {
		                $('#ent_rz').val(data.ent_rz);
                		$('#tcomp_desc').val(data.tcomp_desc);
                		$('#comp_ref_id').val(data.comp_id);

		        });

          	});
			
      });

    function getProvinciapart(sel)
	{	    
	    var dpto_id = sel.value;

        $.get('{{ url('information') }}/create/ajax-state-obtprovincia?dpto_id=' + dpto_id, function(data) {
            $('#prov_idpart').empty();
            $.each(data, function(index,subCatObj){
                $('#prov_idpart').append($('<option>', { 
			        value: subCatObj.prov_id,
			        text: subCatObj.prov_desc
			    }));
            });
        });
	}

	function getDistritopart(sel)
	{	    
	    var prov_id = sel.value;

        $.get('{{ url('information') }}/create/ajax-state-obtdistrito?prov_id=' + prov_id, function(data) {
            $('#dist_idpart').empty();
            $.each(data, function(index,subCatObj){
                $('#dist_idpart').append($('<option>', { 
			        value: subCatObj.dist_id,
			        text: subCatObj.dist_desc
			    }));
            });
        });
	}

	function getProvincialleg(sel)
	{	    
	    var dpto_id = sel.value;

        $.get('{{ url('information') }}/create/ajax-state-obtprovincia?dpto_id=' + dpto_id, function(data) {
            $('#prov_idlleg').empty();
            $.each(data, function(index,subCatObj){
                $('#prov_idlleg').append($('<option>', { 
			        value: subCatObj.prov_id,
			        text: subCatObj.prov_desc
			    }));
            });
        });
	}

	function getDistritolleg(sel)
	{	    
	    var prov_id = sel.value;

        $.get('{{ url('information') }}/create/ajax-state-obtdistrito?prov_id=' + prov_id, function(data) {
            $('#dist_idlleg').empty();
            $.each(data, function(index,subCatObj){
                $('#dist_idlleg').append($('<option>', { 
			        value: subCatObj.dist_id,
			        text: subCatObj.dist_desc
			    }));
            });
        });
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
<div class="content">
	<div class="row">
		<div class="col-md-12 col-centered">
			<div class="card border-success-400">
				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Nueva Nota de Crédito</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/guiaremisionemitida/crear">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="comp_est" value="ACTIVO" >
						<input type="hidden" name="comp_ref_id" id="comp_ref_id" value="" >
						<input type="hidden" name="tcomp_id" value="6"  > <!-- 6 guia remision-->
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Nro</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_nro" id="comp_nro"  value="{{ old('comp_nro') }}">
									</div>
									<input type="text" id="label" style="border-width:0;font-size: 15px; color:red" readonly="readonly">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Descripción</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_descrip" value="{{ old('comp_descrip') }}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Nro</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_ref" id="comp_ref"  value="{{ old('comp_ref') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">F. Emisión de Guía</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="comp_fecha"  value="{{ old('comp_fecha') }}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Cliente</label>
									<div>
										<input type="text" disabled="" class="form-control text-uppercase border-success" name="ent_rz" id="ent_rz">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Tipo Comprobante</label>
									<div>
										<input type="text" disabled="" class="form-control text-uppercase border-success" name="tcomp_desc" id="tcomp_desc">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Vendedor</label>
									<div>
										<select class="form-control text-uppercase" name="vend_id">
										   @foreach ($vendedores as $vendedor)
										   		<option  value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Observaciones</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="comp_obs" value="{{ old('comp_obs') }}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Unidad</label>
									<div>
										<select class="form-control text-uppercase" name="uni_id">
											@foreach ($unidades as $unidad)
											   <option  value='{{$unidad->uni_id}}'>{{$unidad->uni_desc}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Motivo de Traslado</label>
									<div>
										<select class="form-control text-uppercase" name="mtras_id">
											@foreach ($motivotraslados as $motivotraslado)
											   <option  value='{{$motivotraslado->mtras_id}}'>{{$motivotraslado->mtras_desc}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Transbordo Programado</label>
									<div>
										<input type="radio" checked="checked" class="radio-inline" name="adig_transprog" value="SI">Sí
										<input type="radio" class="radio-inline" name="adig_transprog" value="NO">No
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Peso Bruto</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="adig_pbruto" value="{{ old('adig_pbruto') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Nro. de Bultos</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="adig_nbulto" value="{{ old('adig_nbulto') }}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Modalidad Traslado</label>
									<div>
										<select class="form-control text-uppercase" name="adig_mtrasl">
											   <option>TRANSPORTE PUBLICO</option>
											   <option>TRANSPORTE PRIVADO</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">F. Inicio Traslado</label>
									<div>
										<input type="date" class="form-control text-uppercase" name="adig_ftrasl"  value="{{ old('adig_ftrasl') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Tipo Doc. Transportista</label>
									<div>
										<select class="form-control text-uppercase" name="adig_tdoctrans">
											   <option>DNI</option>
											   <option>RUC</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Nro. Documento Transportista</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="adig_doctrans" value="{{ old('adig_doctrans') }}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Razón Social</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="adig_rztrans" value="{{ old('adig_rztrans') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Nro. Placa Vehículo</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="adig_nroplaca" value="{{ old('adig_nroplaca') }}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Tipo Doc. Conductor</label>
									<div>
										<select class="form-control text-uppercase" name="adig_tdoccond">
											   <option>DNI</option>
											   <option>RUC</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Nro. Documento Conductor</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="adig_doccond" value="{{ old('adig_doccond') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Departamento de Partida</label>
									<div>
										<select class="form-control text-uppercase" name="dpto_idpart" id="dpto_idpart" onchange="getProvinciapart(this)">
											@foreach ($departamentos as $departamento)
											   <option  value='{{$departamento->dpto_id}}'>{{$departamento->dpto_desc}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Provincia  de Partida</label>
									<div>
										<select class="form-control text-uppercase" name="prov_idpart" id="prov_idpart" onchange="getDistritopart(this)">
											<option value=0>Elija Provincia</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Distrito  de Partida</label>
									<div>
										<select class="form-control text-uppercase" name="dist_idpart" id="dist_idpart">
											<option value=0>Elija Distrito</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Dirrección de Partida</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="adig_dirpart" value="{{ old('adig_dirpart') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Departamento de Llegada</label>
									<div>
										<select class="form-control text-uppercase" name="dpto_idlleg" id="dpto_idlleg" onchange="getProvincialleg(this)">
											@foreach ($departamentos as $departamento)
											   <option  value='{{$departamento->dpto_id}}'>{{$departamento->dpto_desc}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Provincia  de Llegada</label>
									<div>
										<select class="form-control text-uppercase" name="prov_idlleg" id="prov_idlleg" onchange="getDistritolleg(this)">
											<option value=0>Elija Provincia</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Distrito  de Llegada</label>
									<div>
										<select class="form-control text-uppercase" name="dist_idlleg" id="dist_idlleg">
											<option value=0>Elija Distrito</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Dirrección de Llegada</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="adig_dirlleg" value="{{ old('adig_dirlleg') }}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Nro. Contenedor</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="adig_ncontenedor" value="{{ old('adig_ncontenedor') }}">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Código de Puerto</label>
									<div>
										<input type="text" class="form-control text-uppercase" name="adig_codpuerto" value="{{ old('adig_codpuerto') }}">
									</div>
								</div>
							</div>
						</div>
						<input type="text" hidden="" name="adig_paispart" value="PE">
						<input type="text" hidden="" name="adig_paislleg" value="PE">
						<div class="form-group">
							<div class="text-right">
								<a href="/validado/guiaremisionemitida" class="btn btn-danger" role="button">Cancelar</a>
								<button type="submit" class="btn btn-primary">Crear y Añadir Detalle</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
