<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div style="width: 100%;">
                <div style="position: relative; padding-bottom: 56.25%; padding-top: 0; height: 0;">
                    <iframe frameborder="0" width="1200" height="675" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="<?php echo $row_media->url; ?>" type="text/html" allowscriptaccess="always" allowfullscreen="true" scrolling="yes" allownetworking="all"></iframe>
                </div>
            </div>
        </div>
    </div>
    <form action="<?php echo base_url('Video/is_checked/'.$sum_modules); ?>" id='frm-send' method="POST">
        <div class="row">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <input type="hidden" name="url" value="<?php echo base_url(uri_string()); ?>">
            <input type="hidden" id="module_id" name="module_id" value="1" />
            <input type="hidden" id="multi_media_id" name="multi_media_id" value="<?php echo $row_media->id; ?>" />
            <input type="hidden" class="sum_modules" name="sum_modules" value="<?php echo $sum_modules; ?>">
            <div class="col-md-4" styles="margin: 7px 0px;">
                <?php if( $this->input->get('q') !="free" ){ ?>
                <a href='<?php echo base_url("document?course_id=$course_id"); ?>'>
                    <button class="btn btn-primary" type="button">ENVIAR TALLER</button>
                </a>
                <?php } ?>
            </div>
            <div class="col-md-4" style="margin: 7px 1px;">
                <?php if( $this->input->get('q') !="free" ){ ?>
                    <?php if( $doc > 0 ){ ?>
                        <?php if( $videos->is_checked > 0 ){ ?>
                            <button class="btn btn-danger" type="button">VALIDADO</button>
                        <?php }else{ ?>
                            <button class="btn btn-primary" onclick="return confirm('Desea continuar?')" type="submit">VALIDAR</button>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-md-4" style="background-color: blueviolet;border-radius: 10px;margin: 7px 0px; width: 100%!important;">
                <?php if( $this->input->get('q') !="free" ){ ?>
                <p>
                    <a style="text-decoration: none;color: white;" href="<?php echo base_url("document?course_id=$course_id"); ?>">
                        Para dar en "VALIDAR" primero debes cargar el taller
                    </a>
                </p>
                <?php } ?>
            </div>
        </div>
    </form>
</div>