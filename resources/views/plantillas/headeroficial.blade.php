<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Sistema de Gestión de Proyectos</title>

	<!-- Global stylesheets -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	@yield('css')
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset('global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{asset('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('global_assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>

	<script src="{{asset('assets/js/app.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/forms/selects/select2.full.min.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_pages/content_page_header.js')}}"></script>
	<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
	<script src="{{asset('global_assets/js/demo_pages/datatables_basic.js')}}"></script>

	<script src="{{asset('global_assets/js/sgp/zelect.js')}}"></script>

	<!-- /theme JS files -->
	@yield('javascript')
</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-xl navbar-dark bg-dark navbar-component mb-0">
		<div class="navbar-brand">
			<a href="index.html" class="d-inline-block">
				<img src="../../../../global_assets/images/logo_light.png" alt="">
			</a>
		</div>

		<div class="d-xl-none">
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-nav-lists">
				<i class="icon-menu"></i>
			</button>
		</div>

		<div class="navbar-collapse collapse" id="navbar-nav-lists">
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Mantenimiento</a>

					<div class="dropdown-menu">
						<a href="/validado/almacen" class="dropdown-item"><i class="icon-chrome"></i> Almacen</a>
						<a href="/validado/familia" class="dropdown-item"><i class="icon-chrome"></i> Familias de Producto</a>
						<a href="/validado/categoria" class="dropdown-item"><i class="icon-chrome"></i> Categorias de Producto</a>
						<a href="/validado/unidadmedida" class="dropdown-item"><i class="icon-chrome"></i> Unidades de Medida</a>
						<a href="/validado/conversion" class="dropdown-item"><i class="icon-chrome"></i> Conversiones</a>
						<a href="/validado/producto" class="dropdown-item"><i class="icon-chrome"></i> Productos</a>
						<a href="/validado/unidadproducto" class="dropdown-item"><i class="icon-chrome"></i> Unidades de Medida por Producto</a>
						<a href="/validado/cliente" class="dropdown-item"><i class="icon-chrome"></i> Clientes</a>
						<a href="/validado/proveedor" class="dropdown-item"><i class="icon-chrome"></i> Proveedores</a>
						<a href="/validado/vendedor" class="dropdown-item"><i class="icon-chrome"></i> Vendedores</a>
						<a href="/validado/inventario" class="dropdown-item"><i class="icon-chrome"></i> Inventario</a>
						<a href="/validado/tipogasto" class="dropdown-item"><i class="icon-chrome"></i> Tipo de Gasto</a>
						<a href="/validado/tipocc" class="dropdown-item"><i class="icon-chrome"></i> Centro de Costo</a>
					</div>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Operaciones</a>

					<div class="dropdown-menu">
						<a href="/validado/ingreso" class="dropdown-item"><i class="icon-chrome"></i> Compras</a>
						<a href="/validado/salida" class="dropdown-item"><i class="icon-chrome"></i> Ventas</a>
						<a href="/validado/notacreditoemitida" class="dropdown-item"><i class="icon-chrome"></i> Notas de Credito Emitidas</a>
						<a href="/validado/notacreditorecibida" class="dropdown-item"><i class="icon-chrome"></i> Notas de Credito Recibidas</a>
						<a href="/validado/guiaremisionemitida" class="dropdown-item"><i class="icon-chrome"></i> Guías de Remisión Emitidas</a>
						<a href="/validado/npedido" class="dropdown-item"><i class="icon-chrome"></i> Nota de Pedido</a>
						<a href="/validado/ndebito" class="dropdown-item"><i class="icon-chrome"></i> Nota de Debito</a>
						<a href="/validado/salidaexterno" class="dropdown-item"><i class="icon-chrome"></i> Gastos</a>
						<a href="/validado/notacredito" class="dropdown-item"><i class="icon-chrome"></i> Notas de Credito</a>
						<a href="/validado/caja" class="dropdown-item"><i class="icon-chrome"></i> Caja</a>
					</div>
				</li>
			</ul>
			
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a href="" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Reportes</a>
					<div class="dropdown-menu">
						<a href="/validado/reporte" class="dropdown-item"><i class="icon-chrome"></i>Reportes</a>
					</div>
					
				</li>
			</ul>
			
			
			<ul class="navbar-nav ml-xl-auto">
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="{{asset('global_assets/images/demo/users/face11.jpg')}}" class="rounded-circle" alt="">
						<span>{{Auth::user()->usu_nom}}</span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="/validacion/salida"  class="dropdown-item"><i class="icon-switch2"></i>Cerrar Sesión</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			
			@yield('content')
			
			<!-- /content area -->


			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2018 <a href="https://www.binarioconsultores.com" target="_blank">Binario Consultores</a>
					</span>

					<ul class="navbar-nav ml-lg-auto">
						<li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
						<li class="nav-item"><a href="http://demo.interface.club/limitless/docs/" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
						<li class="nav-item"><a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov" class="navbar-nav-link font-weight-semibold"><span class="text-pink-400"><i class="icon-cart2 mr-2"></i> Purchase</span></a></li>
					</ul>
				</div>
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>

@yield('javascriptfinal')
</html>