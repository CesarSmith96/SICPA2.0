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

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-8 col-centered">
			<div class="card border-success-400">

				<div class="card-header header-elements-inline bg-dark">
					<h6 class="card-title">Editar Conversión</h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
	            	</div>
				</div>
				<div class="card-body border-success-400">
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/conversion/editar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="conv_id" value="{{$conversion->conv_id}}" >
						<div class="form-group">
							<label class="control-label">Unidad de Medida 1</label>
							<div>
								<select class="form-control" name="um_id1">
									@foreach ($unidadmedidas as $unidadmedida)
										@if($unidadmedida->um_id == $conversion->um_id1)
											<option selected  value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
										@else
											<option  value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Factor de Conversión</label>
							<div>
								<input type="text" class="form-control  text-uppercase" name="conv_fact" value="{{$conversion->conv_fact}}" >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Unidad de Medida 2</label>
							<div>
								<select class="form-control" name="um_id2">
									@foreach ($unidadmedidas as $unidadmedida)
										@if($unidadmedida->um_id == $conversion->um_id2)
											<option selected  value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
										@else
											<option  value='{{$unidadmedida->um_id}}'>{{$unidadmedida->um_desc}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/conversion" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Editar<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
