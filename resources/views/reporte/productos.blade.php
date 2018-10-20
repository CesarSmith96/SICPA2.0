<?php
	ob_start();
?>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	</head>
	<table border=\"1\" align=\"center\">
		<font size='6' color='#084B8A'><center>REPORTE DE PRODUCTOS</center></font>
					<tr bgcolor=\"#FDFEFE\"  align=\"center\"  height='40'>
						<th bgcolor='#1B4F72' width="3000px" ><font color="#FDFEFE"><strong>Codigo</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Descripcion</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Observaciones</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Exonerado</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>U.Medida</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Familia</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Sub Familia</strong></font></th>
					</tr>
					
			@if(sizeof($productos)>0)
				

				@foreach ($productos as $producto)
					<tr>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$producto->prod_cod}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$producto->prod_desc}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$producto->prod_obs}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$producto->prod_exo}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$producto->unidadmedida->um_desc}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$producto->categoria->familia->fam_desc}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$producto->categoria->cat_desc}}</strong></td>
					</tr>
				@endforeach

			@else
				<div class="alert alert-danger">
					<p>Al parecer no tiene comprobantes</p>
				</div>
			@endif

			</table>

		</div>
  </body>
</html>

<?php
	$reporte = ob_get_clean();
	header("Content-type: application/vnd.ms-excel");  
	header("Content-Disposition: attachment; filename=Resumen.xls");  
	header("Pragma: no-cache");  
	header("Expires: 0");   

	echo $reporte;  
?>
