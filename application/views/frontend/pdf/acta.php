

<?php

#echo html_entity_decode($html, ENT_QUOTES | ENT_XML1, 'UTF-8');

?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		/** 
            Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
            puede ser de altura y anchura completas.
         **/
        @page {
            margin: 0cm 0cm;
        }
		.margen{
			margin: 0px;
			background-size: 100%;
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
			<td class="text-center bold"><br><br>CERTIFICACIÓN DE ACTA DE GRADUACIÓN
NUGOLO ,<br><br></td>
		</tr>
		<tr>
			<td class="text-center bold"><br><br>C E R T I F I C A  A:<br><br></td>
		</tr>
		<tr>
			<td>
				<br><br>
				<table border="0" style="width: 100%;">
					<tr>
						<td style="width: 10%;">&nbsp;</td>
						<td  style="width: 80%;">	
							<?php echo $nombre_estudiante; ?> por haber cursado de forma exitosa y haber completado el proceso académico, tomandose registro. Haber tenido a la vista el Acta No. <?php echo $numero_acta; ?> <?php echo $fecha_acta; ?>, del libro de Actas de Certificación.
						</td>
						<td style="width: 10%;">&nbsp;</td>
					</tr>
				</table>
				<br><br>
				<br><br>
			</td>
		</tr>
		<tr>
			<td class="text-center">
				<br>
				<?php echo $firma; ?>
				<br><br>
				<br><br>
				Gerente NUGOLO
				<br><br>
			</td>
		</tr>
	</table>
</body>
</html>