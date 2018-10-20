@extends('app')

<script src="https://code.jquery.com/jquery-1.10.2.js"></script> 
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

<style>
    #hh { font-size: 16px; color: #1e1f19; background-color: #f3f3f3; padding: 10px 20px; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; }
    #hh { color: #7A7A78; }
    #intro { margin-bottom: 8px; }
    #intro:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }

    #intro .zelect {
      display: inline-block;
      background-color: white;
      min-width: 300px;
      cursor: pointer;
      line-height: 36px;
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
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Nueva Nota de Crédito</div>
				<div class="panel-body">
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
						<div class="form-group">
							<label class="col-md-4 control-label">Nro</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_nro" id="comp_nro"  value="{{ old('comp_nro') }}">
							</div>
							<input type="text" id="label" style="border-width:0;font-size: 15px; color:red" readonly="readonly">
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Descripción</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_descrip" value="{{ old('comp_descrip') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Nro</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_ref" id="comp_ref"  value="{{ old('comp_ref') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Cliente</label>
							<div class="col-md-6">
								<input type="text" disabled="" class="form-control text-uppercase" name="ent_rz" id="ent_rz">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Tipo Comprobante</label>
							<div class="col-md-6">
								<input type="text" disabled="" class="form-control text-uppercase" name="tcomp_desc" id="tcomp_desc">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">F. Emisión de Guía</label>
							<div class="col-md-6">
								<input type="date" class="form-control text-uppercase" name="comp_fecha"  value="{{ old('comp_fecha') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Vendedor</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="vend_id">
								   @foreach ($vendedores as $vendedor)
								   		<option  value='{{$vendedor->vend_id}}'>{{$vendedor->vend_nom}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Observaciones</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="comp_obs" value="{{ old('comp_obs') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Unidad</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="uni_id">
									@foreach ($unidades as $unidad)
									   <option  value='{{$unidad->uni_id}}'>{{$unidad->uni_desc}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Motivo de Traslado</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="mtras_id">
									@foreach ($motivotraslados as $motivotraslado)
									   <option  value='{{$motivotraslado->mtras_id}}'>{{$motivotraslado->mtras_desc}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Transbordo Programado</label>
							<div class="col-md-6">
								<input type="radio" checked="checked" class="radio-inline" name="adig_transprog" value="SI">Sí
								<input type="radio" class="radio-inline" name="adig_transprog" value="NO">No
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Peso Bruto</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="adig_pbruto" value="{{ old('adig_pbruto') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Nro. de Bultos</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="adig_nbulto" value="{{ old('adig_nbulto') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Modalidad Traslado</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="adig_mtrasl">
									   <option>TRANSPORTE PUBLICO</option>
									   <option>TRANSPORTE PRIVADO</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">F. Inicio Traslado</label>
							<div class="col-md-6">
								<input type="date" class="form-control text-uppercase" name="adig_ftrasl"  value="{{ old('adig_ftrasl') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Tipo Doc. Transportista</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="adig_tdoctrans">
									   <option>DNI</option>
									   <option>RUC</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Nro. Documento Transportista</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="adig_doctrans" value="{{ old('adig_doctrans') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Razón Social</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="adig_rztrans" value="{{ old('adig_rztrans') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Nro. Placa Vehículo</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="adig_nroplaca" value="{{ old('adig_nroplaca') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Tipo Doc. Conductor</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="adig_tdoccond">
									   <option>DNI</option>
									   <option>RUC</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Nro. Documento Conductor</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="adig_doccond" value="{{ old('adig_doccond') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Departamento de Partida</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="dpto_idpart" id="dpto_idpart" onchange="getProvinciapart(this)">
									@foreach ($departamentos as $departamento)
									   <option  value='{{$departamento->dpto_id}}'>{{$departamento->dpto_desc}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Provincia  de Partida</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="prov_idpart" id="prov_idpart" onchange="getDistritopart(this)">
									<option value=0>Elija Provincia</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Distrito  de Partida</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="dist_idpart" id="dist_idpart">
									<option value=0>Elija Distrito</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Dirrección de Partida</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="adig_dirpart" value="{{ old('adig_dirpart') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Departamento de Llegada</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="dpto_idlleg" id="dpto_idlleg" onchange="getProvincialleg(this)">
									@foreach ($departamentos as $departamento)
									   <option  value='{{$departamento->dpto_id}}'>{{$departamento->dpto_desc}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Provincia  de Llegada</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="prov_idlleg" id="prov_idlleg" onchange="getDistritolleg(this)">
									<option value=0>Elija Provincia</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Distrito  de Llegada</label>
							<div class="col-md-6">
								<select class="form-control text-uppercase" name="dist_idlleg" id="dist_idlleg">
									<option value=0>Elija Distrito</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Dirrección de Llegada</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="adig_dirlleg" value="{{ old('adig_dirlleg') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Nro. Contenedor</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="adig_ncontenedor" value="{{ old('adig_ncontenedor') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Código de Puerto</label>
							<div class="col-md-6">
								<input type="text" class="form-control text-uppercase" name="adig_codpuerto" value="{{ old('adig_codpuerto') }}">
							</div>
						</div>
						
						<input type="text" hidden="" name="adig_paispart" value="PE">
						<input type="text" hidden="" name="adig_paislleg" value="PE">
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Crear y Añadir Detalle
								</button>
								<a href="/validado/guiaremisionemitida" class="btn btn-danger" role="button">Cancelar</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
