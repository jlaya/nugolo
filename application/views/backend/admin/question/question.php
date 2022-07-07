<!DOCTYPE html>
<html>
<head>
	<title>Encuesta</title>
    <link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/frontend/css/bootstrap-tagsinput.css'; ?>">
    <script src="<?php echo base_url('assets/backend/js/jquery-1.11.0.min.js'); ?>"></script>
    <script src="<?php echo base_url().'assets/frontend/js/bootstrap-tagsinput.min.js'; ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            var value_required = $("#value_required").val();
            var value_type     = $("#value_type").val();
            $("#required").val(value_required);
            $("#type").val(value_type);
            
           $('.tagsInput').tagsInput({
             'width':'100%',
             'interactive':true,
             'delimiter': ',',   // Or a string with a single delimiter. Ex: ';'
             'removeWithBackspace' : true,
             'minChars' : 0,
             'maxChars' : 0, // if not provided there is no limit
             'placeholderColor' : '#666666'
           });

           var value = $("#type").val();

            if( value == "input" || value == "textarea" ){
                $("#length").show();
            }else if( value == "video" ){
                $("#video").show();
                $("#video").attr("required", true );
            }else{
                $("#length").val("");
                $("#length").hide();
            }

           $('#type').change(function(){

                var value = $(this).val();
                $("#video").attr("required", false );

                if( value == "input" || value == "textarea" ){
                    $("#length").show();
                }else if( value == "video" ){
                    $("#video").show();
                    $("#video").attr("required", true );
                }else{
                    $("#length").val("");
                    $("#length").hide();
                    $("#video").val("");
                    $("#video").hide();
                }

           });


        });
    </script>
</head>
<body>
	<form action="<?php echo base_url('Question/save_question') ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo (isset($detail->id)) ? $detail->id : 0; ?>">
        <input type="hidden" name="question_info_id" value="<?php echo (isset($detail->question_info_id)) ? $detail->question_info_id : $id; ?>">
        <br>
        <textarea required="" class="form-control" name="question" placeholder="Formule una pregunta" style="width: 100%;"><?php echo (isset($detail->question)) ? $detail->question : ""; ?></textarea>
        <br>
        <select required="" class="form-control select2" id="required" name="required" style="width: 100%;">
        	<option value="">Campo obligatorio</option>
        	<option value="1">SI</option>
        	<option value="2">NO</option>
        </select>
        <br>
        <select required="" class="form-control" id="type" name="type" style="width: 100%;">
        	<option value="">Seleccione un campo</option>
        	<option value="input">Campo de texto</option>
        	<option value="select">Selecci&oacute;n simple</option>
        	<option value="checkbox">Campo para tildar</option>
        	<option value="radio">Campo de escogencia &uacute;nica</option>
            <option value="video">Presentación de video</option>
        </select>
        <br>
        <input placeholder="Longitud de campo" type="text" id="length" name="length" class="form-control" style="display: none;">
        <br>
        <input placeholder="Dirección URL del Video" type="text" id="video" name="video" class="form-control" style="display: none;" value="<?php echo (isset($detail->video)) ? $detail->video : ""; ?>">
        <br>
        <textarea id="values" name="values" class="form-control tagsInput" style="width: 100%;display: block;" placeholder="Formule las opciones"><?php echo (isset($detail->value)) ? $detail->value : ""; ?></textarea>
        <br>
        <input type="submit" value="Guardar">
        <a href="<?php echo base_url('Question') ?>">
            <input type="button" value="Volver">
        </a>
    </form>
    <br>
    <!-- Lista -->
    <table border="0" style="width: 100%;">
    <?php 
    foreach ($obj as $key => $value) { ?>
        <tr>
            <th><?php echo $value->question; ?></th>
            <th>
                <a href='<?php echo base_url("Question/detail_question/$value->id") ?>'>
                    <button>Editar</button>
                </a>
            </th>
            <th>
                <a href='<?php echo base_url("Question/delete_question/$value->question_info_id/$value->id") ?>'>
                    <button>Eliminar</button>
                </a>
            </th>
        </tr>
    <?php } ?>
    </table>
</body>
</html>
<input type="hidden" id="value_required" value="<?php echo (isset($detail->required)) ? $detail->required : ""; ?>">
<input type="hidden" id="value_type" value="<?php echo (isset($detail->type)) ? $detail->type : ""; ?>">