<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Mensajes</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/Article-Clean.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/Newsletter-Subscription-Form.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/styles.css')?>">
    <style type="text/css">
      .lat-izq{
        background-color: aquamarine;
        height: 82px;
        overflow: auto;
        scrollbar-width: thin;
        scrollbar-color: #debfff #b0ffff;
      }
      .lat-drech{
        background-color: #7fecc7;
        overflow: scroll;
        height: inherit;
        overflow-x: hidden;
        scrollbar-width: thin;
        scrollbar-color: #debfff #b0ffff;
      }
      .newsletter-subscribe {
        padding: 0px 0!important;
        width: 100%;
      }
      @media (min-width: 768px){
        .col-md-12 {
          width: 100% !important;
          display: flex !important;
        }
      }
     
     
    .embed-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
    }
    .embed-container iframe {
        position: absolute;
        top:0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .message-chat {
        margin: 0 auto!important;
        overflow-wrap: anywhere !important;
    }
    .ul-hide{
      list-style: none;
    }
    .tbody-style{
      border-style: hidden hidden solid hidden;
      border-width: 2px;
      border-color: white;
    }
    .table-message{
      width: 100%;
    }
    .tr-message{
      background-color: #a3ffe0;
    }
    .tr-date{
      font-size: 11px;
      background-color: aquamarine;
    }
    </style>
</head>

<body>
    <div>
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-6 lat-izq">
                  <ul class="ul-hide">
                      <?php foreach ($channel_group as $key => $value) { ?>
                        <li>
                            <a onclick="show_messages(<?php echo $value->id; ?>);" style="cursor: pointer;" title="Elige un chat para comenzar"><?php echo $value->name; ?></a>
                        </li>
                      <?php } ?>
                  </ul>
              </div>
              <div class="col-md-6 lat-drech">
                  <section style="height: 288px;padding: 1rem 0;">
                      <div class="container">
                          <div class="row">
                              <div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2">
                                  <div class="intro"></div>
                                  <div class="text">
                                      <p>
                                        <div class="message-chat"></div>
                                      </p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </section>
              </div>
          </div>
      </div>
      <div class="col-md-12 inf-mensajes">
        <section class="newsletter-subscribe">
          <form id="frm" method="POST">
              <span id="channel_group_id" style="display: none;"></span>
              <textarea disabled="" class="form-control" id="message" name="message" placeholder="Escribe un mensaje..." style="width: 100%;height: 60px;resize: none;"></textarea>
          </form>
        </section>
    </div>
    </div>
    <script src="<?php echo base_url('assets/backend/js/jquery-1.11.0.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>

</html>
<input type="hidden" id="value_group" value="<?php echo $this->input->get('group'); ?>">
<script type = "text/javascript">

     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

   var show_messages = function( channel_group_id ){
    
    $.ajax({
           url:'<?php echo base_url("Chat/show_messages"); ?>',
           type:'post',
           dataType: "json",
           data : {
              channel_group_id : channel_group_id
           },
           success:  function (res) {
            var div = "";
            $.each(res.messages, function (o,i) {
                div += '<table class="table-message">';
                  div += '<tbody class="tbody-style">';
                    div += '<tr>';
                      div += '<td>' + i.name + '</td>';
                    div += '</tr>';
                    div += '<tr class="tr-message">';
                      div += '<td>' + i.message + '</td>';
                    div += '</tr>';
                    div += '<tr class="tr-date">';
                      div += '<td>' + i.datetime + '</td>';
                    div += '</tr>';
                  div += '</tbody>';
                div += '</table>';
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
           url:'<?php echo base_url("Chat/send"); ?>',
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

</script>