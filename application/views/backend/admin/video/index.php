<!DOCTYPE html>
<html>
<head>
    <title>Video</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/bootstrap.min.css'); ?>">
</head>
<body>

    <?php $token = $this->uri->segment(3); ?>

    <form action="<?php echo base_url('Video/register') ?>" method="POST">
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <input type="hidden" name="status" value="0">
        <select required="" id="type" name="type" style="width: 100%;display: block;">
            <option value="">Formato de video</option>
            <option value="1">Vimeo</option>
            <option value="2">Youtube</option>
            <option value="3">Genially</option>
        </select>
        <br>
        <input type="hidden" name="month" id="month" value="1">
        <!--<select required="" id="month" name="month" style="width: 100%;">
            <option value="" selected="">M&oacute;dulo</option>
            <?php foreach (range(1, 100) as $month) { ?>
            <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
            <?php } ?>
        </select>-->
        <select id="week" name="week" style="width: 100%;display: none;">
            <option value="">Semana</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
        <select id="day" name="day" style="width: 100%;display: none;">
            <option value="">Dia</option>
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miercoles">Miercoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
        </select>
        <br>
        <br>
        <input required="" placeholder="Direccion del video" type="text" name="url" style="width: 98.5%;">
        <br>
        <br>
        <input placeholder="Número de lecciones" type="hidden" name="num_lec" id="num_lec" style="width: 98.5%;" value="0">
        <small style="color:red;display: none;">Nota: Solo aplica como campo obligatorio para video Genially.</small>
        <br>
        <br>
        <input type="submit" value="Guardar">
    </form>
    <br>
    <br>
    <!-- Lista -->
    <div id="accordion">
      
        <?php $i = 0; foreach ($groupBy as $key => $value) { $month = $value->month; ?>
            <div class="card">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-<?php echo $month; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $month; ?>">
                      <?php echo "Módulo #".$month; ?>
                    </button>
                  </h5>
                </div>
                <div id="collapse-<?php echo $month; ?>" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                  <div class="card-body">
                        <?php foreach ($obj as $key => $field) { $id = $field->id ?>
                            <?php if($month == $field->month){ ?>
                                <?php echo $field->day; ?>
                                <ul>
                                    <li>
                                        <?php echo $field->url ?>&nbsp;&nbsp;
                                        <a onclick="return confirm('Desea eliminar?')" title="Click para Eliminar" style="cursor: pointer;" href='<?php echo base_url("Video/delete/$id/$token") ?>'>
                                            <button>Eliminar</button>
                                        </a>
                                    </li>
                                </ul>
                            <?php } ?>
                        <?php } ?>
                  </div>
                </div>
            </div>
        <?php $i++; } ?>

    </div>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/vendor/jquery-3.2.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript">
        $( '#type' ).change(function () {
            var type = $(this).val();
            if ( type == 3 ) {
                $("#num_lec").prop("required",true);
            }else{
                $("#num_lec").prop("required",false);
            }
        });
    </script>

</body>
</html>
