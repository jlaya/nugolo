<!DOCTYPE html>
<html>
<head>
    <title>Encuestas</title>
</head>
<body>
    
    <form action="<?php echo base_url('Question/save') ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo (isset($detail->id)) ? $detail->id : 0; ?>">
        <input required="" placeholder="Titulo" type="text" name="title" value="<?php echo (isset($detail->title)) ? $detail->title : ''; ?>" style="width: 100%;">
        <br>
        <br>
        <textarea required="" placeholder="Descripci&oacute;n" type="text" name="description" style="width: 100%;"><?php echo (isset($detail->description)) ? $detail->description : ''; ?></textarea>
        <br>
        <br>
        <input type="submit" value="Guardar">
        <a href="<?php echo base_url('Question') ?>">
            <input type="button" value="Volver">
        </a>
    </form>
    <br>
    <br>
    <!-- Lista -->
    <table border="0">
    <?php 
    foreach ($obj as $key => $value) { ?>
        <tr>
            <th><?php echo $value->title; ?></th>
            <th>
                <a href='<?php echo base_url("Question/detail/$value->id") ?>'>
                    <button>Editar</button>
                </a>
            </th>
            <th>
                <a href='<?php echo base_url("Question/question/$value->id") ?>'>
                    <button>A&ntilde;adir encuesta</button>
                </a>
            </th>
            <th>
                <a href='<?php echo base_url("Question/delete/$value->id") ?>'>
                    <button>Eliminar</button>
                </a>
            </th>
        </tr>
    <?php } ?>
    </table>
    
    

</body>
</html>