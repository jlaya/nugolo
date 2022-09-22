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
		.breakPage{
			page-break-after:always;
		}
	</style>
</head>
<body class="fondo">
	<!--<table class="margen" border="0">
		<tr>
			<td class="text-center">
				<img src="<?php echo base_url('assets/frontend/encabezado-pdf.png'); ?>" style="width: 600px;height: 100px;">
				<br><br><br>
			</td>
		</tr>
	</table>-->
	<table style="width: 100%;">
		<?php foreach ($obj as $key => $value) { ?>
			<tr>
				<td colspan="2">
					<?php echo $value->first_name. ' ' .$value->last_name ; ?>
				</td>
				<td><b>Grado </b><?php echo $value->nivel ; ?></td>
			</tr>
		<?php } ?>
	</table>
	<table style="width: 100%;border-bottom: 1px solid #000000;">
		<?php foreach ($obj as $key => $x) { ?>
			<?php foreach (explode(',', $x->ids) as $id){ ?>
			<?php $courses = $this->crud_model->previewCourse( $id ); ?>
				<?php foreach ($courses as $key => $y) { ?>
				<?php $cancel = $this->crud_model->cancelCourse( $x->user_id, $y->id ); ?>
				<?php $approved = $this->crud_model->approvedCourse( $x->user_id, $y->id ); ?>
				<tr>
					<td>
						<?php echo $y->title; ?>
					</td>
					<td>
						<b>Intentos fallidos: <b><?php echo $cancel->intentos ? $cancel->intentos : 0; ?>
						<br>
						<b>
							<?php
								if( $approved->can == 0 ){
									echo "No aprovado";
								}else{
									echo "Aprovado";
								}
							?>
						</b>
					</td>
					<td>
						<?php foreach ($courses as $key => $c) { ?>
							<!--Contenidos que esta viendo:-->
							<ul>
							<?php foreach (json_decode($c->outcomes) as $outcome){ ?>
								<li><?php echo $outcome; ?></li>
							<?php } ?>
						    </ul>
						<?php } ?>
					</td>
				</tr>
			<?php } ?>
			<?php } ?>
		<?php } ?>
	</table>
</body>
</html>