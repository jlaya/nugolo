<?php
	if( $this->session->userdata('role_id') == 2 ){
		$user_id      = $this->session->userdata('user_id');
		$this->db->select("a.day");
		$this->db->where('a.user_id', $user_id);
        $obj          = $this->db->get('users_detail AS a')->row();
        /*if( $obj->day != "" ){
        	$day      = $obj->day." dias";
        }else{
        	$day      = "";
        }*/
	}
?>
<?php #if( $user_id && $this->session->userdata('role_id') == 2 ){ ?>
	<!--<a class="btn-whatsapp">
		<span class="counter_student">
			<?php echo $day; ?>
		</span>
	</a>-->
<?php #} ?>
<!-- Whatsapp image -->
<a target="_blank" href="https://wa.me/573014701404?text=Hola!%20Estoy%20interesado%20en%20tu%20servicio">
<img title="Whatsapp" class="btn-whatsapp" src="https://clientes.dongee.com/whatsapp.png" width="64" height="64" alt="Whatsapp">
</a>
<style>
	img.btn-whatsapp {
		display: block !important;
		position: fixed;
		z-index: 9999999;
		bottom: 20px;
		right: 20px;
		cursor: pointer;
		border-radius:100px !important;
	}
	img.btn-whatsapp:hover{
		border-radius:100px !important;
		-webkit-box-shadow: 0px 0px 15px 0px rgba(7,94,84,1); 
		-moz-box-shadow: 0px 0px 15px 0px rgba(7,94,84,1);
		box-shadow: 0px 0px 15px 0px rgba(7,94,84,1);
		transition-duration: 1s;
	}

	a.btn-whatsapp {
	    display: block !important;
	    position: fixed;
	    z-index: 9999999;
	    bottom: 20px;
	    right: 100px;
	    cursor: pointer;
	    border-radius: 100px !important;
	    font-size: 31px;
	}
</style>