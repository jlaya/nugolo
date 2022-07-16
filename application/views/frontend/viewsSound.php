
<!-- Play -->
<img class="play" width="60px" style="float: right;overflow: auto;cursor: pointer;" src="<?php echo base_url('assets/sounds/stop.gif'); ?>" title="Reproducir...">
<!-- Stop -->
<img class="stop" width="60px" style="float: right;overflow: auto;cursor: pointer;" src="<?php echo base_url('assets/sounds/play.gif'); ?>" title="Detener...">


<script src="<?php echo base_url('assets/sounds/ion.sound.js'); ?>"></script>
<script>
    $(document).ready(function(){
        ion.sound({
            sounds: [
                {name: "open"}
            ],
            path: "<?php echo base_url('assets/sounds/'); ?>",
            preload: true,
            loop: true,
            volume: 1.0
        });
        // Se inicializa para que se reproduzca automaticamente
        ion.sound.play("open");
        $("img.play").hide();
        $("img.stop").show();
        $("img.play").click(function(){
        	//alert("reproduzca")
            $("img.stop").show();
            $("img.play").hide();
            ion.sound.play("open");
        });
        $("img.stop").click(function(){
            //alert("stop")
            $("img.stop").hide();
            $("img.play").show();
            ion.sound.stop("open");
        });
    });
</script>