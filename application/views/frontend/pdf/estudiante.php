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
	<?php foreach ($obj as $key => $value) { ?>
		<div style="margin-top: 50%;text-align: center;font-weight: bold;font-size: 22px;"><?php echo $value->first_name. ' ' .$value->last_name ; ?></div>
		<div class="breakPage"></div>

		<!-- CURSOS -->
		<?php $previewCourse = $this->crud_model->previewCourse( $value->course_id ); ?>
		<?php $approvedCourse = $this->crud_model->approvedCourse( $value->user_id, $value->course_id ); ?>
		<?php $cancelCourse = $this->crud_model->cancelCourse( $value->user_id, $value->course_id ); ?>
		<?php //if( $approvedCourse->can > 0 ){ ?>
			<!--<h2>Aprovado</h2>-->
		<?php //} ?>
		<br>
		<h3><b>Intentos fallidos: <b><?php echo $cancelCourse->intentos ? $cancelCourse->intentos : 0; ?></h3>
		<br>
		<?php foreach ($previewCourse as $key => $c) { ?>
			<?php echo $c->title; ?>
			<!--Contenidos que esta viendo:-->
			<ul>
			<?php foreach (json_decode($c->outcomes) as $outcome){ ?>
				<li><?php echo $outcome; ?></li>
			<?php } ?>
		    </ul>
		<?php } ?>
		<div class="breakPage"></div>
	<?php } ?>
</body>
</html>