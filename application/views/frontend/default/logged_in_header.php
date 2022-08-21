<?php
    $user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();

    $homework_items = $this->user_model->get_homework_items($this->session->userdata('user_id'));
?>
<style type="text/css">
  .name-users{
    font-size: 14px;
    padding: 0% 0% 0% 5%;
  }
  .user-avatar{
    font-size: 14px;
    padding: 0% 0% 0% 5%;
    border-radius: 25%;
  }
  .menu-area {
      box-shadow: 0 0 1px 1px rgba(20,23,28,.1), 0 3px 1px 0 rgba(20,23,28,.1);
      position: relative;
      z-index: 99;
      background: transparent !important;
  }
  .menu-area .navbar {
    padding: 0;
    background: #31173e !important;
  }
  .container-xl, .container-lg {
    width: 100%;
    padding-right: 20px;
    padding-left: 20px;
    margin-right: auto;
    margin-left: auto;
    background-color: #31173e !important;
  }
</style>
<script type="text/javascript">
  $(document).ready(function() {  
    function toggleNavbarMethod() {  
        if ($(window).width() > 768) {  
            $('.navbar .dropdown').on('mouseover', function(){  
                $('.dropdown-toggle', this).trigger('click');   
            }).on('mouseout', function(){  
                $('.dropdown-toggle', this).trigger('click').blur();  
            });  
        }  
        else {  
            $('.navbar .dropdown').off('mouseover').off('mouseout');  
        }  
    }  
    toggleNavbarMethod();  
    $(window).resize(toggleNavbarMethod);  
}); 
</script>
<section class="menu-area">
    <div class="container-xl">
        <div class="row">
            <div class="col">
               <?php include 'menu-home.php'; ?>
            </div>
        </div>
    </div>
</section>
<?php include("application/views/frontend/viewsSound.php"); ?>
<script type="text/javascript">
    // Captura de los datos en el formulario
   $('ul > li input#is_checked').click(function(){
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

   // funcion para calcular el valor que tendra el contador de cada estudiante
   // y este haga su trabajo automatico.
   function counter_student(){

    $.ajax({
        type:"POST", // la variable type guarda el tipo de la peticion GET,POST,..
        url:"<?php echo base_url('User/counter_student'); ?>",
        success:function(o){
          $("span.counter_student").text( o + " dias" );
         },
        dataType: 'json'
    });

   }

   function counter_student_ready(){

    $.ajax({
        type:"POST", // la variable type guarda el tipo de la peticion GET,POST,..
        url:"<?php echo base_url('User/counter_student_ready'); ?>",
        success:function(o){
          //$("span.counter_student").text( o + " dias" );
         },
        dataType: 'json'
    });

   }

   //counter_student();

   //setInterval(function(){ counter_student_ready(); }, 5000);

</script>
