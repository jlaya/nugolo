<?php if( $this->input->get('q') !="free" ){ ?>
    <object type="application/php" data='<?php echo base_url("chat_private?course_id=$course_id");?>' style="width:100%; height:430px;border-radius: 12px;">
        <embed src='<?php echo base_url("chat_private?course_id=$course_id");?>' style="width:100%; height:430px;border-radius: 12px;" frameborder="0" style="border:0;">
      </object>
  <?php }else{ ?>
      <img src="<?php echo base_url('assets/chat-block.png') ?>" style="width: 100%">
<?php } ?>