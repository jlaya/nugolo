<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		/** 
            Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
            puede ser de altura y anchura completas.
         **/
        /*@page {
            margin: 0cm 0cm;
        }*/
		.margen{
			/*margin: 0px;*/
			/*background-size: 100%;*/
			width: 100%;
		}
		.text-center{
			text-align: center;
		}
		.bold{
			font-weight: bold;
		}
		.fondo1{
			margin: 0;
		}
		.hola{
			margin: 5px;text-align: justify-all;
		}
	</style>
</head>
<body class="fondo">
	<table class="margen" border="0">
		<tr>
			<td class="text-center">
				<img src="<?php echo base_url('assets/frontend/encabezado-pdf.png'); ?>" style="width: 600px;height: 100px;">
				<br><br><br>
			</td>
		</tr>
		<tr>
			<td class="text-center bold">
				Logros
			</td>
		</tr>
		<tr>
			<td>
				<br><br>
				<table class="table text-center" border="1" style="width: 100%;">
					<tr>
						<th>Logro</th>
						<th>Moneda</th>
						<th>Experiencia</th>
					</tr>
					<?php
						$valorCoin = 0;
						$ValorExp = 0;
					?>
					<?php foreach ($obj as $key => $value) { ?>
						<?php if( $value->ValorExp !=0 ){ ?>
						<?php $valorCoin += $value->valorCoin; ?>
						<?php $ValorExp += $value->ValorExp; ?>
						<tr style="text-align: left;">
							<td><?php echo $value->nombre; ?></td>
							<td style="text-align: center;"><?php echo $value->valorCoin; ?></td>
							<td style="text-align: center;"><?php echo $value->ValorExp; ?></td>
						</tr>
						<?php } ?>
					<?php } ?>
					<tr>
						<td></td>
						<td><?php echo $valorCoin; ?></td>
						<td><?php echo $ValorExp; ?></td>
					</tr>
				</table>
				<br><br>
				<br><br>
			</td>
		</tr>
	</table>
</body>
</html>