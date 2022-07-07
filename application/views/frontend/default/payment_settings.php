<?php
$user_data   = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
$paypal_keys = json_decode($user_data['paypal_keys'], true);
$stripe_keys = json_decode($user_data['stripe_keys'], true);
$bank = json_decode($user_data['bank_information'], true);
?>
<section class="user-dashboard-area">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="user-dashboard-box">
                    <div class="user-dashboard-content" style="width: 100%;">
                        <div class="content-title-box">
                            <div class="title"><?php echo get_phrase('payment_settings'); ?></div>
                            <div class="subtitle"><?php echo get_phrase('update_your_payment_settings'); ?>.</div>
                        </div>
                        <form action="<?php echo site_url('home/update_profile/update_payment_settings'); ?>" method="post">
                            <div class="content-box">
                                <!--<div class="basic-group">
                                    <div class="form-group">
                                        <label for="FristName"><?php echo get_phrase('paypal_client_id'); ?>:</label>
                                        <input type="text" class="form-control" name = "paypal_client_id" id="paypal_client_id" placeholder="<?php echo get_phrase('paypal_client_id'); ?>" value="<?php echo $paypal_keys[0]['production_client_id']; ?>">
                                    </div>
                                </div>
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="FristName"><?php echo get_phrase('stripe_public_key'); ?>:</label>
                                        <input type="text" class="form-control" name = "stripe_public_key" id="stripe_public_key" placeholder="<?php echo get_phrase('stripe_public_key'); ?>" value="<?php echo $stripe_keys[0]['public_live_key']; ?>">
                                    </div>
                                </div>
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="FristName"><?php echo get_phrase('stripe_secret_key'); ?>:</label>
                                        <input type="text" class="form-control" name = "stripe_secret_key" id="stripe_secret_key" placeholder="<?php echo get_phrase('stripe_secret_key'); ?>" value="<?php echo $stripe_keys[0]['secret_live_key']; ?>">
                                    </div>
                                </div>-->
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="BankName"><?php echo get_phrase('BankName'); ?>:</label>
                                        <input type="text" class="form-control" name = "BankName" id="BankName" placeholder="<?php echo get_phrase('BankName'); ?>" value="<?php echo $bank[0]['BankName']; ?>">
                                    </div>
                                </div>
                                <div class="basic-group">
                                    <div class="form-group">
                                        <label for="TypeAccount"><?php echo get_phrase('TypeAccount'); ?>:</label>
                                        <select class="form-control select2" id="source" name="TypeAccount" data-init-plugin="select2" >
                                          <option value="0"
                                          <?php if ($bank[0]['TypeAccount'] == 0) echo 'selected';?>>
                                          <?php echo get_phrase('current');?></option>
                                          <option value="1"
                                          <?php if ($bank[0]['TypeAccount'] == 1) echo 'selected';?>>
                                          <?php echo get_phrase('savings');?></option>
                                      </select>
                                  </div>
                                  <div class="basic-group">
                                    <div class="form-group">
                                        <label for="AccountName"><?php echo get_phrase('AccountName'); ?>:</label>
                                        <input type="text" class="form-control" name = "AccountName" id="AccountName" placeholder="<?php echo get_phrase('AccountName'); ?>" value="<?php echo $bank[0]['AccountName']; ?>">
                                    </div>
                                </div>
                                <div class="basic-group">
                                    <div class="form-group">                                       
                                        <label for="BankAccept"><input type="checkbox" name="BankAccept" id="BankAccept" value="1" <?php echo (($bank[0]['BankAccept']===1)?'checked':'checked')?> >
                                        <?php echo get_phrase('BankAccept'); ?></label>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="content-update-box">
                            <button type="submit" class="btn"><?php echo get_phrase('update'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
