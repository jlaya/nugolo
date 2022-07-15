<script src="<?php echo base_url('assets/sounds/ion.sound.js'); ?>"></script>
<script>
    $(document).ready(function(){
        ion.sound({
            sounds: [
                {name: "open"}
            ],
            path: "assets/sounds/",
            preload: true,
            volume: 1.0
        });
        // Se inicializa para que se reproduzca automaticamente
        //ion.sound.play("open");
        $("#play").click(function(){
        	//alert("reproduzca")
            $("#play").hide();
            ion.sound.play("open");
            $("#stop").show();
        });
        $("#stop").click(function(){
            $("#play").show();
            ion.sound.stop("open");
            $("#stop").hide();
        });
    });
</script>