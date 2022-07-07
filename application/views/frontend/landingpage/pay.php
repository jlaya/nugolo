<?php 
    $this->load->library('session');
    $data = $this->session->userdata['users'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo $page_title; ?></title>
	<style type="text/css">
		.action-button {
         margin-top: 20px;
         width: 100px;
         margin-left: auto;
         margin-right: auto;
         background: #1f53c5 !important;
         font-weight: bold;
         color: white !important;
         border: 0 none;
         border-radius: 1px;
         cursor: pointer;
         padding: 10px 5px;
         }
	</style>
</head>
<body style="background-color: #292F45;">
	<hr>
	<p style="text-align: center;color: #FFF;">
		Para realizar el pago solo basta en dar clic al botón de Pagar,
		en esta pantalla se mostrará los Distintos Métodos de pagos y
		los datos de la persona.
	</p>
	<hr>
	<p>
		<?php
		  // 1 = Entorno prueba
		  // 0 = Entorno produccion
		  $test = 0;

		  if( $test == 0 ){
		  	$ApiKey        = 'G92cEz556OwAaMN7Hxq480j595';
			$ApiLogin      = 'tcelI3h2A5D73H0';
			$merchantId    = '904924';
			$description   = 'Compra';
			$amount        = 2500;
			$referenceCode = 'Membresia-'.md5(date("Y-m-d H:i:s"));
			$currency      = 'COP';
			$accountId     = '911624';
			$firma         = "$ApiKey~$merchantId~$referenceCode~$amount~$currency";
			$signature     = md5($firma);
			$buyerEmail    = $data['email'];
			$url           = 'https://checkout.payulatam.com/ppp-web-gateway-payu';
		  }else{
		  	$ApiKey        = '4Vj8eK4rloUd272L48hsrarnUA';
			$ApiLogin      = 'tcelI3h2A5D73H0';
			$merchantId    = '508029';
			$description   = 'Test PAYU';
			$amount        = 3;
			$referenceCode = 'TestPayU';
			$currency      = 'USD';
			$accountId     = '512321';
			$firma         = "$ApiKey~$merchantId~$referenceCode~$amount~$currency";
			$signature     = 'ba9ffa71559580175585e45ce70b6c37';
			$buyerEmail    = $data['email'];
			$url           = 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu';
		  }

		?>
		<?php if( $test == 1 ){ ?>
			<div class="alert alert-danger" style="text-align: center;background-color: orange;padding: 1% 1% 1% 1%;">Transacción en modo de pruebas</div>
		<?php } ?>
		<form method="post" action="<?php echo $url; ?>">
		                         
			     <input name="buyerFullName"    type="hidden"  value="<?php echo $data['first_name'].' '.$data['last_name']; ?>" >
			     <input name="shippingAddress"  type="hidden"  value="<?php echo $data['address']; ?>"/>
			     <input name="merchantId"       type="hidden"  value="<?php echo $merchantId; ?>"   >
			     <input name="accountId"        type="hidden"  value="<?php echo $accountId; ?>" >
			     <input name="description"      type="hidden"    value="<?php echo $description; ?>"  >
			     <input name="referenceCode"    type="hidden"  value="<?php echo $referenceCode; ?>" >
			     <input name="amount" class="form-control" type="hidden" value="<?php echo $amount; ?>" required=""   >
			     <br>
			     <input name="tax"             type="hidden"  value="0"  >
			     <input name="taxReturnBase"   type="hidden"  value="0" >
			     <input name="currency"        type="hidden"  value="<?php echo $currency; ?>" >
			     <input name="shippingCity"    type="hidden"  value="Bogota" >
			     <input name="shippingCountry" type="hidden"  value="CO" >
			     <input name="signature"       type="hidden"  value="<?php echo $signature; ?>"  >
			     <input name="test"            type="hidden"  value="<?php echo $test; ?>" >
			     <input name="buyerEmail"      type="hidden" class="form-control"  placeholder="Correo electrónico" required="" value="<?php echo $buyerEmail; ?>" >
			     <input name="responseUrl"    type="hidden"  value="<?php echo base_url('index.php/Confirmation/details'); ?>" >
			     <input name="confirmationUrl"    type="hidden"  value="<?php echo base_url(); ?>" >
			<input style="margin: 0% 0% 0% 40%;" type="submit" class="submit action-button" value="PAGAR">
		</form>
	</p>

</body>
</html>
