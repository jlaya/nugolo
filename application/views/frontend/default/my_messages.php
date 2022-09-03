<?php
    $instructor_list = $this->user_model->get_instructor_list()->result_array();
    $messageTextUser = $this->user_model->messageTextUser();
?>
<style type="text/css">
     /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }
    section.page-header-area {
      background: #371582;
    }
</style>
<section class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="page-title">Bandeja de entrada</h1>
            </div>
        </div>
    </div>
</section>
<section class="message-area">
    <a style="color: #FFF;" href="<?php echo base_url(); ?>">
      <button class="btn btn-default">
        Volver
      </button>
    </a>
    <!-- Tab links -->
    <div class="tab">
      <button class="tablinks" onclick="openContent(event, 'messageContent', 0)">Mensajeria</button>
      <button class="tablinks" onclick="openContent(event, 'CalifContent', 1)">Calificaciones</button>
    </div>

    <!-- Tab content -->
    <div id="messageContent" class="tabcontent active">
      <div class="container">
        <div class="row no-gutters align-items-stretch">
            <div class="col-lg-5">
                <div class="message-sender-list-box">
                    <button class="btn compose-btn" type="button" id="NewMessage" onclick="NewMessage(event)"; style="color: #FFF">Nuevo hilo</button>
                    <hr>
                    <ul class="message-sender-list">

                        <?php
                        $current_user = $this->session->userdata('user_id');
                        $this->db->where('sender', $current_user);
                        $this->db->or_where('reciever', $current_user);
                        $message_threads = $this->db->get('message_thread')->result_array();
                        foreach ($message_threads as $row):

                            // defining the user to show
                            if ($row['sender'] == $current_user)
                            $user_to_show_id = $row['reciever'];
                            if ($row['reciever'] == $current_user)
                            $user_to_show_id = $row['sender'];

                            $last_messages_details =  $this->crud_model->get_last_message_by_message_thread_code($row['message_thread_code'])->row_array();
                            // Aqui se actualiza los estatus de los mensajes, para dejarlos en visto
                            $this->user_model->updateMessageUser( $row['message_thread_code'] );
                            ?>
                            <a href="<?php echo site_url('home/my_messages/read_message/'.$row['message_thread_code']); ?>">
                                <li>
                                    <div class="message-sender-wrap">
                                        <div class="message-sender-head clearfix">
                                            <div class="message-sender-info d-inline-block">
                                                <div class="sender-image d-inline-block">
                                                    <img src="<?php echo $this->user_model->get_user_image_url($user_to_show_id);?>" alt="" class="img-fluid">
                                                </div>
                                                <div class="sender-name d-inline-block">
                                                    <?php
                                                    $user_to_show_details = $this->user_model->get_all_user($user_to_show_id)->row_array();
                                                    echo $user_to_show_details['first_name'].' '.$user_to_show_details['last_name'];
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="message-time d-inline-block float-right"><?php echo date('D, d-M-Y', $last_messages_details['timestamp']); ?></div>
                                        </div>
                                        <div class="message-sender-body">
                                            <?php echo $last_messages_details['message']; ?>
                                        </div>
                                    </div>
                                </li>
                            </a>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="message-details-box" id = "toggle-1">
                    <?php include 'inner_messages.php'; ?>
                </div>
                <div class="message-details-box" id = "toggle-2" style="display: none;">
                    <div class="new-message-details"><div class="message-header">
                        <div class="sender-info">
                            <span class="d-inline-block">
                                <i class="far fa-user"></i>
                            </span>
                            <span class="d-inline-block"><?php echo get_phrase('new_message'); ?></span>
                        </div>
                    </div>
                    <form class="" action="<?php echo site_url('home/my_messages/send_new'); ?>" method="post">
                        <div class="message-body">
                            <div class="form-group">
                                <select class="form-control select2" name = "reciever">
                                    <?php foreach ($instructor_list as $instructor):
                                        //if ($instructor['id'] == $this->session->userdata('user_id'))
                                        //    continue;
                                        ?>
                                        <option value="<?php echo $instructor['id']; ?>"><?php echo $instructor['first_name'].' '.$instructor['last_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn send-btn"><?php echo get_phrase('send'); ?></button>
                            <button type="button" class="btn cancel-btn" onclick = "CancelNewMessage(event)">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>

    <div id="CalifContent" class="tabcontent">
        <div style="overflow-y: scroll; height: 600px;">
          <?php foreach ($messageTextUser as $key => $value) { ?>
                <div class="alert alert-info">
                    <?php echo $value->text; ?>
                </div>
          <?php } ?>
        </div>
    </div>
</section>
<script type="text/javascript">
    function openContent(evt, cityName, event) {
      // Declare all variables
      var i, tabcontent, tablinks;

      if( event === 1 ){
        $.ajax({
            url: '<?php echo site_url('home/updateMessageUserTeacher/');?>',
            success: function( r )
            {
                //jQuery('#sub_category_id').html(response);
            }
        });
      }

      // Get all elements with class="tabcontent" and hide them
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }

      // Get all elements with class="tablinks" and remove the class "active"
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      // Show the current tab, and add an "active" class to the button that opened the tab
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
</script>
<script type="text/javascript">
function NewMessage(e){

    e.preventDefault();
    $('#toggle-1').hide();
    $('#toggle-2').show();
    $('#NewMessage').removeAttr('onclick');
}

function CancelNewMessage(e){

    e.preventDefault();
    $('#toggle-2').hide();
    $('#toggle-1').show();

    $('#NewMessage').attr('onclick','NewMessage(event)');
}
</script>
