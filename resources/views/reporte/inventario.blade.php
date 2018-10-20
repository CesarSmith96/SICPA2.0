<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>INVENTARIO</title>
		<link href="/css/pdf1.css" rel="stylesheet">
	</head>
	<body onload="window.print()">
		<div>
			<table class="table">
						<tr>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Unidad</th>
							<th>Última actualización</th>							
						</tr>

				@if(sizeof($inventarios)>0)
					

					@foreach ($inventarios as $inventario)
						<tr>
							<td>{{$inventario->producto->prod_desc}}</td>
							<td>{{$inventario->inv_cant}}</td>
							<td>{{$inventario->producto->unidadmedida->um_desc}}</td>
							<td>{{date('d/m/Y', strtotime($inventario->inv_fecha))}}</td>
						</tr>
					@endforeach

				@else
					<div class="alert alert-danger">
						<p>Al parecer su inventario esta vacio</p>
					</div>
				@endif

			</table>

		</div>
  </body>
</html>