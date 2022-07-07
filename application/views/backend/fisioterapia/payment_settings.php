<?php 
    $paypal_settings = $this->db->get_where('settings', array('key' => 'paypal'))->row()->value;
    $paypal = json_decode($paypal_settings);
    $stripe_settings = $this->db->get_where('settings', array('key' => 'stripe_keys'))->row()->value;
    $stripe = json_decode($stripe_settings);
    $paguelofacil_settings = $this->db->get_where('settings', array('key' => 'paguelofacil'))->row()->value;
    $paguelofacil = json_decode($paguelofacil_settings);
?>

<ol class="breadcrumb bc-3">
    <li>
        <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li><a href="#" class="active"><?php echo get_phrase('payment_settings'); ?></a> </li>
</ol>

<h2><i class="fa fa-arrow-circle-o-right"></i> <?php echo $page_title; ?></h2>
<br />
<div class="row">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">
        <div class="col-md-7">
          <form class="" action="<?php echo site_url('admin/payment_settings/update'); ?>" method="post" enctype="multipart/form-data">
                  <div class="panel-group" id="accordion" data-toggle="collapse">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="" data-toggle="collapse" data-parent="#accordion"  href="#collapseOne">
                                        <?php echo get_phrase('system_currency_settings'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="col-md-8 col-sm-8 col-xs-8">

                                          <div class="form-group">
                                              <label class="form-label"><?php echo get_phrase('select_system_currency'); ?></label>
                                              <div class="controls">
                                                  <select class="form-control select2" id="source" name="system_currency" data-init-plugin="select2" >
                                                    <option value=""><?php echo get_phrase('select_system_currency'); ?></option>
                                                      <?php
                                                      $currencies = $this->crud_model->get_currencies();
                                                      foreach ($currencies as $currency):?>
                                                      <option value="<?php echo $currency['code'];?>"
                                                          <?php if (get_settings('system_currency') == $currency['code'])echo 'selected';?>> <?php echo $currency['code'];?>
                                                      </option>
                                                      <?php endforeach; ?>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label class="form-label"><?php echo get_phrase('currency_position'); ?></label>
                                              <div class="controls">
                                                  <select class="form-control select2" id="source" name="currency_position" data-init-plugin="select2" >
                                                      <option value="left" <?php if (get_settings('currency_position') == 'left') echo 'selected';?> ><?php echo get_phrase('left'); ?></option>
                                                      <option value="right" <?php if (get_settings('currency_position') == 'right') echo 'selected';?> ><?php echo get_phrase('right'); ?></option>
                                                      <option value="left-space" <?php if (get_settings('currency_position') == 'left-space') echo 'selected';?> ><?php echo get_phrase('left_with_a_space'); ?></option>
                                                      <option value="right-space" <?php if (get_settings('currency_position') == 'right-space') echo 'selected';?> ><?php echo get_phrase('right_with_a_space'); ?></option>
                                                  </select>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="" data-toggle="collapse" data-parent="#accordion"  href="#collapseTwo">
                                        <?php echo get_phrase('paypal_settings'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="col-md-8 col-sm-8 col-xs-8">

                                      <div class="form-group">
                                          <label class="form-label"><?php echo get_phrase('active'); ?></label>
                                          <div class="controls">
                                              <select class="form-control select2" id="source" name="paypal_active" data-init-plugin="select2" >
                                                  <option value="0"
                                              <?php if ($paypal[0]->active == 0) echo 'selected';?>>
                                                  <?php echo get_phrase('no');?></option>
                                          <option value="1"
                                              <?php if ($paypal[0]->active == 1) echo 'selected';?>>
                                                  <?php echo get_phrase('yes');?></option>

                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="form-label"><?php echo get_phrase('mode'); ?></label>
                                          <div class="controls">
                                              <select class="form-control select2" id="source" name="paypal_mode" data-init-plugin="select2" >
                                                  <option value="sandbox"
                                              <?php if ($paypal[0]->mode == 'sandbox') echo 'selected';?>>
                                              <?php echo get_phrase('sandbox');?></option>
                                          <option value="production"
                                              <?php if ($paypal[0]->mode == 'production') echo 'selected';?>>
                                              <?php echo get_phrase('production');?></option>

                                              </select>
                                          </div>
                                      </div>

                                        <div class="form-group">
                                            <label class="form-label"><?php echo get_phrase('client_id').' ('.get_phrase('sandbox').')'; ?></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="sandbox_client_id" value="<?php echo $paypal[0]->sandbox_client_id;?>"  />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label"><?php echo get_phrase('client_id').' ('.get_phrase('production').')'; ?></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="production_client_id" value="<?php echo $paypal[0]->production_client_id;?>"  />
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="form-label"><?php echo get_phrase('paypal_currency'); ?></label>
                                            <div class="controls">
                                              <select class="form-control select2" id="paypal_currency" name="paypal_currency" data-init-plugin="select2"  required>
                                                <option value=""><?php echo get_phrase('select_paypal_currency'); ?></option>
                                                  <?php
                                                  $currencies = $this->crud_model->get_paypal_supported_currencies();
                                                  foreach ($currencies as $currency):?>
                                                  <option value="<?php echo $currency['code'];?>"
                                                      <?php if (get_settings('paypal_currency') == $currency['code'])echo 'selected';?>> <?php echo $currency['code'];?>
                                                  </option>
                                                  <?php endforeach; ?>
                                              </select>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---Paguelo FAcil-->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="" data-toggle="collapse" data-parent="#accordion"  href="#collapseTwo">
                                        <?php echo get_phrase('paguelo_facíl_settings'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="col-md-8 col-sm-8 col-xs-8">

                                      <div class="form-group">
                                          <label class="form-label"><?php echo get_phrase('active'); ?></label>
                                          <div class="controls">
                                              <select class="form-control select2" id="source" name="paguelofacil_active" data-init-plugin="select2" >
                                                  <option value="0"
                                              <?php if ($paguelofacil[0]->active == 0) echo 'selected';?>>
                                                  <?php echo get_phrase('no');?></option>
                                          <option value="1"
                                              <?php if ($paguelofacil[0]->active == 1) echo 'selected';?>>
                                                  <?php echo get_phrase('yes');?></option>

                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label class="form-label"><?php echo get_phrase('SANDBOX'); ?></label>
                                          <div class="controls">
                                              <select class="form-control select2" id="source" name="paguelofacil_sandbox" data-init-plugin="select2" >
                                                  <option value="0"
                                              <?php if ($paguelofacil[0]->sandbox == 0) echo 'selected';?>>
                                                  <?php echo get_phrase('no');?></option>
                                              <?php echo strtoupper(get_phrase('sandbox'));?></option>
                                         <option value="1"
                                              <?php if ($paguelofacil[0]->sandbox == 1) echo 'selected';?>>
                                                  <?php echo get_phrase('yes');?></option>

                                              </select>
                                          </div>
                                          <?php echo '<small class="text-justify">'.get_phrase('SandBox,_cuando_use_por_primera_vez_para_hacer_una_prueba_del_funcionamiento.').'</small>'; ?>
                                          
                                      </div>
                                      <div class="form-group hidden">
                                          <label class="form-label"><?php echo get_phrase('on_site'); ?></label>
                                          <div class="controls">
                                              <select class="form-control select2" id="source" name="paguelofacil_onsite" data-init-plugin="select2" >
                                                  <option value="0"
                                              <?php if ($paguelofacil[0]->onsite == 0) echo 'selected';?>>
                                                  <?php echo get_phrase('no');?></option>
                                              <?php echo strtoupper(get_phrase('onsite'));?></option>
                                         <option value="1"
                                              <?php if ($paguelofacil[0]->onsite == 1) echo 'selected';?>>
                                                  <?php echo get_phrase('yes');?></option>

                                              </select>
                                              <?php echo '<small class="text-justify">'.get_phrase('onSite_si_habilita_esta_opción_el_usuario_nunca_saldrá_de_su_sitio_web_para_realizar_el_pago.').'</small>'; ?>
                                          </div>
                                      </div>
                                      <p class="row-fluid text-justify hidden">
                                        <?php echo '<small class="text-justify hidden">'.get_phrase('<strong>_Acreditar_y_Company</strong>_deben_ser_llenados_con_los_datos_suministrados_con_PagueloFacil.com_para_que_funcione_perfectamente_el_modo_onSite.').'</small>'; ?>
                                      </p>
                                        <div class="form-group hidden">
                                            <label class="form-label"><?php echo (get_phrase('acreditar')) ?></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="paguelofacil_acreditar" value="<?php echo $paguelofacil[0]->acreditar;?>"  />
                                            </div>
                                        </div>
                                        <div class="form-group hidden">
                                            <label class="form-label"><?php echo (get_phrase('company')) ?></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="paguelofacil_company" value="<?php echo $paguelofacil[0]->company;?>"  />
                                            </div>
                                        </div>
                                        <p class="row-fluid text-justify"></p>
                                        <div class="form-group">
                                            <label class="form-label"><?php echo strtoupper(get_phrase('URL')) ?></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="paguelofacil_url" value="<?php echo $paguelofacil[0]->url;?>"  />
                                            </div>              
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label"><?php echo strtoupper(get_phrase('CCLW')) ?></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="paguelofacil_CCLW" value="<?php echo $paguelofacil[0]->CCLW;?>"  />
                                            </div>
                                            <?php echo '<small>'.get_phrase('Inserte_el_CCLW_suministrado_por_la_empresa.').'</small>'; ?>
                                        </div>
                                        <div class="form-group hidden">
                                            <label class="form-label"><?php echo (get_phrase('desripción')) ?></label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="paguelofacil_description" value="<?php echo $paguelofacil[0]->description;?>"  />
                                            </div>
                                            <?php echo '<small class="text-justify">'.get_phrase('Información_que_desee_que_su_cliente_lea_al_momento_de_seleccionar_PagueloFacil_como _tipo_de_pago.').'</small>'; ?>
                                        </div>
                    
                                        <div class="form-group">
                                            <label class="form-label"><?php echo get_phrase('paguelo_facíl_currency'); ?></label>
                                            <div class="controls">
                                              <select class="form-control select2" id="paguelofacil_currency" name="paguelofacil_currency" data-init-plugin="select2"  required>
                                                <option value=""><?php echo get_phrase('select_paguelo_facíl_currency'); ?></option>
                                                  <?php
                                                  $currencies = $this->crud_model->get_paguelofacil_supported_currencies();
                                                  foreach ($currencies as $currency):?>
                                                  <option value="<?php echo $currency['code'];?>"
                                                      <?php if (get_settings('paguelofacil_currency') == $currency['code'])echo 'selected';?>> <?php echo $currency['code'];?>
                                                  </option>
                                                  <?php endforeach; ?>
                                              </select>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Paguelo Facil-->
                        <div class="panel panel-default hidden">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="" data-toggle="collapse" data-parent="#accordion"  href="#collapseThree">
                                        <?php echo get_phrase('stripe_settings'); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse in">
                                <div class="panel-body">
                                  <div class="col-md-8 col-sm-8 col-xs-8">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo get_phrase('active'); ?></label>
                                        <div class="controls">
                                            <select class="form-control select2" id="source" name="stripe_active" data-init-plugin="select2" >
                                                <option value="0"
                                                        <?php if ($stripe[0]->active == 0) echo 'selected';?>>
                                                            <?php echo get_phrase('no');?></option>
                                                    <option value="1"
                                                        <?php if ($stripe[0]->active == 1) echo 'selected';?>>
                                                            <?php echo get_phrase('yes');?></option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"><?php echo get_phrase('testmode'); ?></label>
                                        <div class="controls">
                                            <select class="form-control select2" id="source" name="testmode" data-init-plugin="select2" >
                                                <option value="on"
                                                   <?php if ($stripe[0]->testmode == 'on') echo 'selected';?>>
                                                       <?php echo get_phrase('on');?></option>
                                               <option value="off"
                                                   <?php if ($stripe[0]->testmode == 'off') echo 'selected';?>>
                                                       <?php echo get_phrase('off');?></option>
                                            </select>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                        <label class="form-label"><?php echo get_phrase('test_secret_key') ?></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="secret_key" value="<?php echo $stripe[0]->secret_key;?>"  />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label"><?php echo get_phrase('test_public_key') ?></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="public_key" value="<?php echo $stripe[0]->public_key;?>"  />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label"><?php echo get_phrase('live_secret_key') ?></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="secret_live_key" value="<?php echo $stripe[0]->secret_live_key;?>"  />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label"><?php echo get_phrase('live_public_key') ?></label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="public_live_key" value="<?php echo $stripe[0]->public_live_key;?>"  />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label"><?php echo get_phrase('stripe_currency'); ?></label>
                                        <div class="controls">
                                          <select class="form-control selectboxit" id="source" name="stripe_currency" data-init-plugin="select2">
                                            <option value=""><?php echo get_phrase('select_stripe_currency'); ?></option>
                                              <?php
                                              $currencies = $this->crud_model->get_stripe_supported_currencies();
                                              foreach ($currencies as $currency):?>
                                              <option value="<?php echo $currency['code'];?>"
                                                  <?php if (get_settings('stripe_currency') == $currency['code'])echo 'selected';?>> <?php echo $currency['code'];?>
                                              </option>
                                              <?php endforeach; ?>
                                          </select>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="">
                    <div class="form-group col-md-6" style="margin-top: 10px;">
                        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('save_changes'); ?></button>
                    </div>
                  </div>
              </form>
        </div>
        <div class="col-md-5">
          <div class="alert alert-info"><strong><?php echo get_phrase('heads_up') ?>! </strong> <?php echo get_phrase('please_make_sure_that').' "'.get_phrase('system_currency').'", '.'"'.get_phrase('paypal_currency').'", "'.get_phrase('paguelofacil_currency').'" y '.'"'.get_phrase('stripe_currency').'" '.get_phrase('are_same'); ?>.</div>
        </div>
			</div>
		</div>
</div>

<script type="text/javascript">

</script>
