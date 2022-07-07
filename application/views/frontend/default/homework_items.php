<?php
    $user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();

    $homework_items = $this->user_model->get_homework_items($this->session->userdata('user_id'));
?>
<div class="icon">
    <a href="#" style="border: 1px solid transparent; margin: 10px 10px; font-size: 14px; width: 100%; border-radius: 0;">Reto</a>
</div>
<div class="dropdown course-list-dropdown corner-triangle top-right">
    <div class="list-wrapper">
        <div class="item-list">
            <ul>
                <?php if(count($homework_items) > 0){ ?>
                    <?php foreach ($homework_items as $key => $value) { ?>
                        <li style="padding:15px 20px;">
                            <!--<a href="<?php echo $value->url; ?>" style="color: #000000;">-->
                            <a href="#" style="color: #000000;">
                                <span style="background-color: <?php echo $value->color; ?>;width: 1.5%;">&nbsp;</span>
                                <?php echo $value->name; ?>
                                <?php
                                    if( $value->is_checked == 1 ){
                                        $checked  = 'checked="checked"';
                                        $disabled = 'disabled';
                                    }else{
                                        $checked  = '';
                                        $disabled = '';
                                    }
                                ?>
                                <input <?php echo $checked; ?> data-id="<?php echo $value->id; ?>" type="checkbox" id="is_checked" >
                            </a>
                        </li>
                    <?php } ?>
                <?php }else{ ?>
                    <li>
                        No se encuentran tareas asignadas...
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    // Captura de los datos en el formulario
   $('#is_checked').click(function(){
      var id         = $(this).data('id');
      var checked = $(this).is(':checked');
      if( checked == true ){
        is_checked = 1;
      }else{
        is_checked = 0;
      }
      //se utiliza $.ajax(), a la cual se le pasa un objeto {}, con la información
      $.ajax({
          type:"POST", // la variable type guarda el tipo de la peticion GET,POST,..
          url:"<?php echo base_url('Confirmation/is_checked'); ?>", //url guarda la ruta hacia donde se hace la peticion
          data: {
            'id':id,
            'is_checked':is_checked
          } , // data recive un objeto con la informacion que se enviara al servidor
          success:function(datos){

           },
          dataType: 'json' // El tipo de datos esperados del servidor. Valor predeterminado: Intelligent Guess (xml, json, script, text, html).
      });
   });
</script>
