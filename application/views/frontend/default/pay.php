<?php 
    
    $user_id        = $this->session->userdata('user_id');
    $course_id      = $this->input->get('course_id');
    $course_details = $this->crud_model->get_course_by_id($course_id)->row();
    $course         = $course_details->title;
    $price          = $course_details->price;
    $test           = config_item("is_active_payu");

    // Se pregunta si la variable state esta definida
    if( $this->input->get('state') == 'DECLINED' ){
        $state = "Transacci&oacute;n rechazada";
    }else{
        $state = "";
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?php echo get_phrase($page_title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link name="favicon" type="image/x-icon" href="<?php echo base_url().'assets/favicon.png' ?>" rel="shortcut icon" />
    <!-- BEGIN PLUGIN CSS -->
    <?php include 'application/views/backend/includes_top.php'; ?>
    <style type="text/css">
        select.form-control:not([size]):not([multiple]) {
            height: auto !important;
        }
        h3{
            color: #FFF;
        }
    </style>
  </head>
  <!-- END HEAD -->
<body class="page-body" style="background: linear-gradient(338deg, #00205b, #37163b);color: #FFF;">
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
      <?php #include 'application/views/backend/'.$logged_in_user_role.'/navigation.php' ?>
      <div class="">
        <?php #include 'application/views/backend/header.php';?>
        <br>
        <br>
        <form autocomplete="off" action="<?php echo site_url('Home/payu/1'); ?>" method="post" role="form" enctype= multipart/form-data class="form-horizontal form-groups-bordered">
            <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
            <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
            <input type="hidden" name="TX_VALUE" id="TX_VALUE" value="<?php echo $price; ?>">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h3 class="text-center"><?php echo $course; ?></h3>
                <br><br>
                <div class="form-group">
                    <label for="price" class="col-sm-3 control-label">Precio</label>

                    <div class="col-sm-5">
                        <?php echo $price; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Modalidad de pago</label>

                    <div class="col-sm-5">
                        <select class="form-control" id="type" name="type" required="" onchange="checked_value(value);">
                            <option value="">---</option>
                            <option value="1">Tarjeta de credito</option>
                            <option value="2">Transferencia bancaria (PSE)</option>
                        </select>
                    </div>
                </div>

                <div class="panel-STATE_PAY form-group" <?php if ( $test == 'false' ){ echo "style='display:none'"; } ?>>
                    <label for="STATE_PAY" class="col-sm-3 control-label">Estado</label>

                    <div class="col-sm-5">
                        <select class="form-control" name="STATE_PAY" id="STATE_PAY" onchange="change_STATE_PAY(value);" required="">
                            <option value="">---</option>
                            <option <?php if ( $test == 'false' ){ echo "selected"; } ?> value="APPROVED">Aprovado</option>
                            <option value="REJECTED">Declinado</option>
                        </select>
                    </div>
                </div>

                <!-- Payer = pagador -->
                <div class="form-group" style="display: none;">
                    <label for="payer" class="col-sm-3 control-label"><h3>Pagador</h3></label>
                    <div class="col-sm-9"></div>
                </div>

                <div class="form-group">
                    <label for="payer-fullName" class="col-sm-3 control-label">Nombre completo</label>

                    <div class="col-sm-5">
                        <input type="text" name="payer-fullName" id="payer-fullName" class="form-control" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="payer-emailAddress" class="col-sm-3 control-label">Correo eléctronico</label>

                    <div class="col-sm-5">
                        <input type="text" name="payer-emailAddress" id="payer-emailAddress" class="form-control" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="payer-contactPhone" class="col-sm-3 control-label">Teléfono</label>

                    <div class="col-sm-5">
                        <input type="text" name="payer-contactPhone" id="payer-contactPhone" class="form-control" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="payer-dniNumber" class="col-sm-3 control-label">Número de identificación</label>

                    <div class="col-sm-5">
                        <input type="text" name="payer-dniNumber" id="payer-dniNumber" class="form-control" required="">
                    </div>
                </div>
                <!-- Dirección de envío del comprador -->
                <div class="form-group">
                    <label for="payer" class="col-sm-3 control-label"><h3>Dirección de envío</h3></label>
                    <div class="col-sm-9"></div>
                </div>
                <div class="form-group">
                    <label for="payer-street1" class="col-sm-3 control-label">Dirección</label>

                    <div class="col-sm-5">
                        <input type="text" name="payer-street1" id="payer-street1" class="form-control" required="">
                    </div>
                </div>
                <div class="form-group" style="display: none;">
                    <label for="payer-street2" class="col-sm-3 control-label">Dirección 2 del pagador</label>

                    <div class="col-sm-5">
                        <input type="text" name="payer-street2" id="payer-street2" class="form-control" value="0">
                    </div>
                </div>
                <div class="form-group">
                    <label for="payer-city" class="col-sm-3 control-label">Ciudad</label>

                    <div class="col-sm-5">
                        <input type="text" name="payer-city" id="payer-city" class="form-control" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="payer-state" class="col-sm-3 control-label">Estado</label>

                    <div class="col-sm-5">
                        <input type="text" name="payer-state" id="payer-state" class="form-control" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="payer-postalCode" class="col-sm-3 control-label">Código postal</label>

                    <div class="col-sm-5">
                        <input type="text" name="payer-postalCode" id="payer-postalCode" class="form-control" required="">
                    </div>
                </div>
                <div class="form-group" style="display: none;">
                    <label for="payer-phone" class="col-sm-3 control-label">Teléfono 2</label>

                    <div class="col-sm-5">
                        <input type="text" name="payer-phone" id="payer-phone" class="form-control" value="0">
                    </div>
                </div>

                <div class="creditCard" style="display: none;">

                    <div class="form-group">
                        <label for="number" class="col-sm-3 control-label">Número de tarjeta</label>

                        <div class="col-sm-5">
                            <input type="number" name="number" id="number" class="form-control creditCard-input" maxlength="16" value="0" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="securityCode" class="col-sm-3 control-label">Código de seguridad</label>

                        <div class="col-sm-5">
                            <input type="number" name="securityCode" id="securityCode" class="form-control creditCard-input" maxlength="3" placeholder="CVV" value="0" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="expirationDate" class="col-sm-3 control-label">Fecha de expiración</label>

                        <div class="col-sm-5">
                            <input type="text" name="expirationDate" id="expirationDate" class="form-control creditCard-input" maxlength="7" value="0" required="" placeholder="0000/00">
                        </div>
                    </div>

                </div>
                <div class="extraParameters" style="display: none;">

                    <div class="form-group">
                        <label for="FINANCIAL_INSTITUTION_CODE" class="col-sm-3 control-label">Banco</label>

                        <div class="col-sm-5">
                            <select class="form-control" name="FINANCIAL_INSTITUTION_CODE" id="FINANCIAL_INSTITUTION_CODE">
                                <option value="">---</option>
                                <?php foreach ($banks as $key => $value) { ?>
                                    <option value="<?php echo $value->pseCode ?>">
                                        <?php echo $value->description ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="USER_TYPE" class="col-sm-3 control-label">Tipo de persona</label>

                        <div class="col-sm-5">
                            <select class="form-control" name="USER_TYPE" id="USER_TYPE">
                                <option value="">---</option>
                                <option value="N">Natural</option>
                                <option value="J">Jurídica</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="PSE_REFERENCE2" class="col-sm-3 control-label">Documento de identificación</label>

                        <div class="col-sm-5">
                            <select class="form-control" name="PSE_REFERENCE2" id="PSE_REFERENCE2">
                                <option value="">---</option>
                                <option value="CC">Cédula de ciudadanía.</option>
                                <option value="CE">Cédula de extranjería.</option>
                                <option value="NIT">Número de Identificación Tributaria (Empresas).</option>
                                <option value="TI">Tarjeta de identidad.</option>
                                <option value="PP">Pasaporte.</option>
                                <option value="IDC">Identificador único de cliente, para el caso de ID’s únicos de clientes/usuarios de servicios públicos.</option>
                                <option value="CEL">En caso de identificarse a través de la línea del móvil.</option>
                                <option value="RC">Registro civil de nacimiento.</option>
                                <option value="DE">Documento de identificación extranjero.</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="PSE_REFERENCE3" class="col-sm-3 control-label">Número de documento</label>

                        <div class="col-sm-5">
                            <input type="text" name="PSE_REFERENCE3" id="PSE_REFERENCE3" class="form-control" value="0" required="">
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button class = "btn btn-success" type="submit" name="button">Pagar</button>
                        <a href="<?php echo base_url('announce'); ?>">
                            <button class = "btn btn-info" type="button">Volver</button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <?php #include 'application/views/backend/footer.php';?>
    </div>
    </div>
</body>
<?php include 'application/views/backend/includes_bottom.php'; ?>
<script type="text/javascript">
    function change_STATE_PAY(element){
        var state = element;

        if (state == 'APPROVED'){
            $("#number").val("4037997623271984");
            $("#securityCode").val("777");
            $("#expirationDate").val("2025/05");
        }else if (state == 'REJECTED'){
            $("#number").val("4509420000000008");
            $("#securityCode").val("666");
            $("#expirationDate").val("2027/07");
        }

    }

    change_STATE_PAY('APPROVED');

    function checked_value(element){
        if( element == 1 ){
            $("div.creditCard").show();
            $("div.extraParameters").hide();
            $("input.creditCard-input").val('');
            //$(".panel-STATE_PAY").show();
        }else if( element == 2 ){
            $("div.extraParameters").show();
            $("div.creditCard").hide();
            $("input.extraParameters-input").val('');
            //change_STATE_PAY('APPROVED');
            //$(".panel-STATE_PAY").hide();
        }else{
            $("div.creditCard").hide();
            $("input.creditCard-input").val(0);
            $("div.extraParameters").hide();
            $("input.extraParameters-input").val(0);
        }
    }
</script>
<?php if( $this->input->get('state') == 'DECLINED' ){ ?>
<script type="text/javascript">
    toastr.error("<?php echo $state ?>");
</script>
<?php } ?>
</html>
