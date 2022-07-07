<!DOCTYPE html>
<html>
<head>
  <title>Nugolo</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">﻿
  <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/bootstrap.css'); ?>">
  <style type="text/css">
    a,span,h3{
      color: #FFF;
    }
    .jumbotron {
        padding-top: 32px;
        padding-bottom: 32px;
        background-color: #bdc4df;
    }

    .label-info {
        background-color: #21a9e1;
        font-size: 15px;
    }

    h1, .h1 {
        font-size: 31px;
        color: #FFF;
    }

    .content-messages{
      padding: 1% 1% 1% 1%;
      margin: 1%;
      background-color: #515c7b;
      color: #FFF;
      margin: 1% 0% 2% 5%;
      width: 80%;
    }

  </style>
  <style type="text/css">
            @font-face {
            
            font-family: "boombox";
            src: url("<?php echo base_url('assets/frontend/fonts/boombox.ttf'); ?>");
            
            font-family: "Bebas-Regular";
            src: url("<?php echo base_url('assets/frontend/fonts/Bebas-Regular.ttf'); ?>");
            
            font-family: "GameOfSquids";
            src: url("<?php echo base_url('assets/frontend/fonts/GameOfSquids.ttf'); ?>");
            }
        .button-1{
            color: #FFF;
            font-weight: bold;
            border-color: #5cdac9;
            background-color: #5cdac9;
        }
        .color-571894{
            width: 140px;
            height: 30px;
            color: #FFF;
            font-weight: bold;
            border: none; 
            background-color: #54178f;
            border-radius: 15px;
            border: 1px solid;
            border-color: #b858fe;
        }
        .color-FFF{
            font-family: "GameOfSquids";
            color: #FFF;
            font-weight: bold;
            border: none; 
            background-color: transparent;
        }
        .color-000{
            font-family: "GameOfSquids";
            color: #000;
            font-weight: bold;
            border: none; 
            background-color: transparent;
        }
        .h1-font{
            color: #FFF;
            font-family: "boombox" !important;
        }.h3-font{
            color: #FFF;
        }

        /* Tipografias 
        .boombox2{
            font-family: "boombox2";
            src: url("<?php echo base_url('assets/frontend/fonts/boombox2.ttf'); ?>");
        }
        .bebas{
            font-family: "Bebas-Regular";
            src: url("<?php echo base_url('assets/frontend/fonts/Bebas-Regular.ttf'); ?>");
        }
        .gameofsquids{
            font-family: "Game Of Squids";
            src: url("<?php echo base_url('assets/frontend/fonts/Game-Of-Squids.ttf'); ?>");
        }
        */
        
        .container {
            display:inline-block;
            width: 100vw;
        }
 
 
 
                     .cielo-1 {
                      width: 100vw;
                      height: 400vh;
                      background: transparent;
                      position: absolute;
                      -webkit-animation: animaCielo 15s linear infinite backwards running;
                      -moz-animation: animaCielo 15s linear infinite backwards running;
                      -ms-animation: animaCielo 15s linear infinite backwards running;
                      animation: animaCielo 15s linear infinite backwards running;
                    }
                    .cielo-1 .estrella {
                      background: #497c95;
                      position: absolute;
                      width: 2px;
                      height: 2px;
                      border-radius: 50%;
                    }
                    
                    .cielo-2 {
                      
                      width: 100%;
                      height: 400%;
                      position: absolute;
                      -webkit-animation: animaCielo 13s linear infinite backwards running;
                      -moz-animation: animaCielo 13s linear infinite backwards running;
                      -ms-animation: animaCielo 13s linear infinite backwards running;
                      animation: animaCielo 13s linear infinite backwards running;
                    }
                    .cielo-2 .estrellaDos {
                      background: #704995;
                      position: absolute;
                      width: 2px;
                      height: 2px;
                      border-radius: 50%;
                    }
                    
                    @-webkit-keyframes animaCielo {
                      0% {
                        top: -100%;
                      }
                      100% {
                        top: 0%;
                      }
                    }
                    @-ms-keyframes animaCielo {
                      0% {
                        top: -100%;
                      }
                      100% {
                        top: 0%;
                      }
                    }
                    @-o-keyframes animaCielo {
                      0% {
                        top: -100%;
                      }
                      100% {
                        top: 0%;
                      }
                    }
                    @-moz-keyframes animaCielo {
                      0% {
                        top: -100%;
                      }
                      100% {
                        top: 0%;
                      }
                    }

    </style>
    <style>
        /* Estilos para motores Webkit y blink (Chrome, Safari, Opera... )*/

        #contenedor::-webkit-scrollbar {
            -webkit-appearance: none;
        }

        #contenedor::-webkit-scrollbar:vertical {
            width:10px;
        }

        #contenedor::-webkit-scrollbar-button:increment,.contenedor::-webkit-scrollbar-button {
            display: none;
        } 

        #contenedor::-webkit-scrollbar:horizontal {
            height: 10px;t
        }

        #contenedor::-webkit-scrollbar-thumb {
            background-color: #d56bff;
            border-radius: 20px;
            
        }

        #contenedor::-webkit-scrollbar-track {
            border-radius: 10px;  
        }

        body{
            font-family: 'Open Sans', sans-serif;
            padding-right: 0 !important;
            color: #FFF;
            font-size: 15px;
        }
    </style>
  <script src="<?php echo base_url('assets/backend/js/jquery-1.11.0.min.js'); ?>"></script>
</head>
<body style="background: linear-gradient(338deg, #00205b, #37163b);">

  <div class="container">
    <div class="row panel-channel">
      <div class="col">
        <div class="table-responsive">
          <div style="float: left;border-style:groove;width: 30%;height: 455px;overflow-y: scroll;">
            <?php foreach ($channel_group as $key => $value) { ?>
              <div style="margin: 0% 0% 1% 3%;">
                <a onclick="show_messages(<?php echo $value->id; ?>);" style="cursor: pointer;" title="Elige un chat para comenzar"><?php echo $value->name; ?></a>
              </div>
            <?php } ?>
          </div>
          <div style="float: left;border-style:groove;width: 70%;height: 455px;overflow-y: scroll;">
            <div class="message-chat">
              <h3 style="margin: 50% 0% 0% 22%;">Elige un chat para comenzar</h3>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <form id="frm" method="POST">
              <span id="channel_group_id" style="display: none;"></span>
              <textarea disabled="" class="form-control" id="message" name="message" placeholder="Escribe un mensaje..."></textarea>
              <br>
              <small class="warning-message" style="color: red;font-weight: bold;font-size: 14px;"></small>
          </form>
          <?php //if( $this->session->userdata('role_id') == 4 || $this->session->userdata('role_id') == 5 ){ ?>
            <br>
            <?php if( $this->session->userdata('role_id') == 1 ){ ?>
            <input type="button" class="btn btn-info" onclick="show_form_group();" value="Panel">
            <?php } ?>
            <button style="display: none;" type="button" class="btn btn-success" onclick="redirect_site();">Ir al Sistema</button>
        <?php //} ?>
        </div>
      </div>
    </div>
    <div class="row panel-group" style="display: none;">
      <div class="col">
          <table border="0" width="30%;border-spacing: 5px;border-collapse: separate;">
            <?php foreach ($channel_group as $key => $value) { ?>
              <tr>
                <td style="padding: 15px;"><?php echo $value->name; ?></td>
                <td>
                  <button class="btn btn-danger">
                    <a href='<?php echo base_url("chat/close_group/$value->id") ?>'>
                    Cerrar grupo
                    </a>
                  </button>
                </td>
                <td>
                  <button class="btn btn-success" onclick="show_member_users(<?php echo $value->id; ?>,'<?php echo $value->name; ?>');">Añadir miembros</button>
                </td>
              </tr>
            <?php } ?>
          </table>
          <br>
          <form action="<?php echo base_url('chat/register'); ?>" id="frm-group" method="POST">
            <input required="" class="form-control" type="text" name="name" id="name" placeholder="Nombre del grupo">
            <br>
            <input class="btn btn-info" type="submit" value="Guardar grupo">
            <button type="button" class="btn btn-success" onclick="show_chat();">Abrir Mensajeria</button>
          </form>
      </div>
    </div>
    <div class="col show-member-users" style="display: none;">
        <br>
        <div class="alert alert-info show-name-group" style="background-color: #515c7b;border-color: #515c7b;color: #FFF;"></div>
        <form action="<?php echo base_url('chat/join_channel_group_users'); ?>" method="POST">
          <input type="hidden" id="channel_group_id" name="channel_group_id">
          <ul class="content-users"></ul>
          <button type="button" class="btn btn-info" onclick="show_panel_group();">Ir al panel</button>
          <button type="button" class="btn btn-success" onclick="show_chat();">Abrir Mensajeria</button>
        </form>
      </div>
  </div>
</body>
<input type="hidden" id="value_group" value="<?php echo $this->input->get('group'); ?>">
<script type = "text/javascript">

    if( $("#value_group").val() == 1 ){
      $("div.panel-channel").hide(1000);
      $("div.panel-group").show(1000);
     }else{
      $("div.panel-channel").show(1000);
     }

     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

     // Mostrar panel de administracion de grupos
     var redirect_site = function(){
        //window.history.back();
        window.close();
     }

     // Mostrar panel de administracion de grupos
     var show_form_group = function(){
        $("div.panel-channel").hide(1000);
        $("div.panel-group").show(1000);
     }

     // Mostrar panel de administracion de grupos
     var show_panel_group = function(){
        $("div.show-member-users").hide(1000);
        $("div.panel-group").show(1000);
     }

     // Mostrar Chat
     var show_chat = function(){
        $("div.show-member-users").hide(1000);
        $("div.panel-group").hide(1000);
        $("div.panel-channel").show(1000);
     }

     // Ingresar nuevos miembros al canal de chat
     var show_member_users = function(channel_group_id,name){

        $("div.show-name-group").text(name);
        $("div.panel-group").hide(1000);
        $("div.show-member-users").show(1000);

        $.ajax({
           url:'Chat/users',
           dataType: "json",
           type:'post',
           data : {channel_group_id : channel_group_id},
           success:  function (res) {
            $html = "";
            $.each(res, function (x,y) {

                var checked = "";
                if( y.id == y.user_id ){
                  checked = "checked";
                }

                $html += "<li>";
                $html += "<input "+checked+" data-user_id='"+y.user_id+"' onclick='join_channel_group_users("+y.id+","+y.user_id+","+channel_group_id+");' type='checkbox' name='user_id[]' value='"+y.id+"'>&nbsp;&nbsp;";
                $html += y.first_name + " " + y.last_name;
                $html +="</li>";
            });

            $("ul.content-users").html($html);

           },
           statusCode: {
              404: function() {
                 alert('Not found');
              }
           },
           error:function(x,xs,xt){
              //window.open(JSON.stringify(x));
              //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
           }
        });

     }

     // Hacer parte del canal
     var join_channel_group_users = function( channel_group_users_id, user_id , channel_group_id ){
      
        $.ajax({
             url:'Chat/joins_channel_group_users',
             type:'post',
             data : {
              channel_group_users_id : channel_group_users_id,
              user_id : user_id,
              channel_group_id : channel_group_id
            },
             success:  function (o) {
              
              //show_member_users(channel_group_id,"");

             },
             statusCode: {
                404: function() {
                   alert('Not found');
                }
             },
             error:function(x,xs,xt){
                //window.open(JSON.stringify(x));
                //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
             }
          });

     }

     var join_channel = function(){
    
    $.ajax({
           url:'Chat/show_channel',
           dataType: "json",
           type:'post',
           success:  function (o) {
            
            if( o.message == 0 ){
              $("input.show-send").hide();
              $("input.show-join").show();
            }else if( o.message > 0 ){
              $("input.show-send").show();
              $("input.show-join").hide();
            }

           },
           statusCode: {
              404: function() {
                 alert('Not found');
              }
           },
           error:function(x,xs,xt){
              //window.open(JSON.stringify(x));
              //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
           }
        });

   };

   var show_messages = function( channel_group_id ){
    
    $.ajax({
           url:'Chat/show_messages',
           type:'post',
           dataType: "json",
           data : {
              channel_group_id : channel_group_id
           },
           success:  function (res) {
            var div = "";
            $.each(res.messages, function (o,i) {
                div += '<div class="row">';
                div += '<div class="col content-messages">';
                    div += "&nbsp;&nbsp;" + i.message;
                    div += "<hr><span class='label label-info'>" + i.name + "</span>&nbsp;&nbsp;</br></br>" + i.datetime + "";
                  div += '</div>';
                div += '</div>';
            });
            
            $('div.message-chat').html(div);
            $("#channel_group_id").text(channel_group_id);

            if( res.permission_channel > 0 ){
              $("div.message-chat").css("font-size","none");
              $("div.message-chat").css("margin","none");
              $('textarea#message').prop("disabled",false);
            }else{
              $('textarea#message').prop("disabled",true);
              $("div.message-chat").css("font-size","21px");
              $("div.message-chat").css("margin","50% 0% 0% 22%");
              $("div.message-chat").text("Disculpe, no tiene permiso a este canal");

            }

           },
           statusCode: {
              404: function() {
                 alert('Not found');
              }
           },
           error:function(x,xs,xt){
              //window.open(JSON.stringify(x));
              //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
           }
        });

   };

   setInterval(function(){
    var channel_group_id = $("#channel_group_id").text();
    if( channel_group_id !="" ){
      show_messages( channel_group_id );
    }
   }, 3000);

   // Evento keypress
   $('textarea#message').keyup(function(e){

      e.preventDefault();

      if(e.which == 13) {

        var channel_group_id = $("#channel_group_id").text();
        var message          = $("#message").val();

        if( message.trim() == "" ){
          alert("Ingrese un mensaje");
          $("#message").val("");
          return false;
        }
        
        //we will send data and recive data fom our AjaxController
        //alert("im just clicked click me");
        $.ajax({
           url:'Chat/send',
           data : {
              channel_group_id : channel_group_id,
              message : message
           },
           type:'post',
           success:  function (response) {
            show_messages(channel_group_id);
            $("#message").val("");
           },
           statusCode: {
              404: function() {
                 alert('Not found');
              }
           },
           error:function(x,xs,xt){
              //window.open(JSON.stringify(x));
              //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
           }
        });

      }

     });

     $('input.join-channel').click(function(){

        //we will send data and recive data fom our AjaxController
        //alert("im just clicked click me");
        $.ajax({
           url:'Chat/join_channel',
           dataType: "json",
           type:'post',
           success:  function (response) {
            $("input.show-join").hide();
            $("input.show-send").show();
            show_messages();
           },
           statusCode: {
              404: function() {
                 alert('Not found');
              }
           },
           error:function(x,xs,xt){
              window.open(JSON.stringify(x));
              //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
           }
        });
     });
</script>

</html>