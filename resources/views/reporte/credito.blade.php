<?php
	ob_start();
?>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	</head>
	<table border=\"1\" align=\"center\">
		<font size='6' color='#084B8A'><center>REPORTE DE VENTAS</center></font>
					<tr bgcolor=\"#FDFEFE\"  align=\"center\"  height='40'>
						<th bgcolor='#1B4F72' width="3000px" ><font color="#FDFEFE"><strong>Nro.</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Tipo</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>RUC o DNI</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>R. Social</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Zona</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Vendedor</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Fecha</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Subtotal</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>IGV</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Total</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Saldo</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Moneda</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>Dias</strong></font></th>
						<th bgcolor='#1B4F72' ><font color="#FDFEFE"><strong>T. C.</strong></font></th>
					</tr>
					
			@if(sizeof($comprobantes)>0)
				

				@foreach ($comprobantes as $comprobante)
					<tr>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$comprobante->comp_nro}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{substr($comprobante->tipocomprobante->tcomp_desc,0,3)}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$comprobante->entidad->ent_ruc}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$comprobante->entidad->ent_rz}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$comprobante->entidad->ent_ciu}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$comprobante->vendedor->vend_nom}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{date('d/m/Y', strtotime($comprobante->comp_fecha))}}</strong></td>

						<?php
							if($comprobante->comp_moneda=='SOLES'){?>
								<td style="mso-number-format:'#,##0.00;-#,##0.00';vertical-align: middle; text-align:right;"><strong>{{number_format($comprobante->comp_subt,2,'.',',')}}</strong></td>
								<td style="mso-number-format:'#,##0.00;-#,##0.00';vertical-align: middle; text-align:right;"><strong>{{number_format($comprobante->comp_igv,2,'.',',')}}</strong></td>
								<td style="mso-number-format:'#,##0.00;-#,##0.00';vertical-align: middle; text-align:right;"><strong>{{number_format($comprobante->comp_tot,2,'.',',')}}</strong></td>
							<?php 
							}else { ?>
								<td style="mso-number-format:'#,##0.00';vertical-align: middle; text-align:right;"><strong>{{number_format($comprobante->comp_subt,2,'.',',')}}</strong></td>
								<td style="mso-number-format:'#,##0.00';vertical-align: middle; text-align:right;"><strong>{{number_format($comprobante->comp_igv,2,'.',',')}}</strong></td>
								<td style="mso-number-format:'#,##0.00';vertical-align: middle; text-align:right;"><strong>{{number_format($comprobante->comp_tot,2,'.',',')}}</strong></td>
						<?php }?>

						<td style="mso-number-format:'#,##0.00';vertical-align: middle; text-align:right;"><strong>{{number_format($comprobante->comp_saldo,2,'.',',')}}</strong></td>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$comprobante->comp_moneda}}</strong></td>
						<?php $hoy=(strtotime(date('Y-m-d',strtotime($comprobante->comp_fven)))-strtotime(date('Y-m-d')))/86400; ?>
						<td style="vertical-align: middle; text-align:left;"><strong>{{$hoy}}</strong></td>
						<td style="vertical-align: middle; text-align:right;"><strong>{{$comprobante->comp_tipcambio}}</strong></td>
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
