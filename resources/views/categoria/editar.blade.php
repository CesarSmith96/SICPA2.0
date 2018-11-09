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
					<h6 class="card-title">Editar Categoria</h6>
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

					<form class="form-horizontal" role="form" method="POST" action="/validado/categoria/editar">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="cat_id" value="{{$categoria->cat_id}}" >
						<div class="form-group">
							<label class="control-label">Descripción</label>
							<div>
								<input type="text" class="form-control text-uppercase" name="cat_desc" value="{{$categoria->cat_desc}}" >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Familia</label>
							<div>
								<select name="fam_id" class="form-control text-uppercase">
									@foreach ($familias as $familia)
										@if($familia->fam_id == $categoria->fam_id)
									   		<option selected value='{{$familia->fam_id}}'>{{$familia->fam_desc}}</option>
									   	@else
											<option  value='{{$familia->fam_id}}'>{{$familia->fam_desc}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
				</div>

				<div class="card-footer d-flex justify-content-between align-items-center bg-dark border-top-0">
				<a href="/validado/categoria" class="btn bg-transparent text-white border-white border-2">Cancelar</a>
				<button type="submit" class="btn btn-outline bg-white text-white border-white border-2">Editar<i class="icon-paperplane ml-2"></i></button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
