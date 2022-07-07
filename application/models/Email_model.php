<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	private $estilos='<style>
			/* -------------------------------------
    GLOBAL
    A very basic CSS reset
------------------------------------- */
			* {
				margin: 0;
				padding: 0;
				font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
				box-sizing: border-box;
				font-size: 14px;
			}

			img {
				max-width: 100%;
			}

			body {
				-webkit-font-smoothing: antialiased;
				-webkit-text-size-adjust: none;
				width: 100% !important;
				height: 100%;
				line-height: 1.6;
			}
			table td {
				vertical-align: top;
			}
			body {
				background-color: #f6f6f6;
			}

			.body-wrap {
				background-color: #f6f6f6;
				width: 100%;
			}

			hr {height:1px; border:none; color:#2c3f5d; background-color:#2c3f5d;} 
			.container {
				display: block !important;
				max-width: 600px !important;
				margin: 0 auto !important;
				/* makes it centered */
				clear: both !important;
			}

			.content {
				max-width: 600px;
				margin: 0 auto;
				display: block;
				padding: 20px;
			}

			/* -------------------------------------
				HEADER, FOOTER, MAIN
			------------------------------------- */
			.main {
				background: #fff;
				border: 1px solid #e9e9e9;
				border-radius: 3px;
			}

			.content-wrap {
				padding: 20px;
			}

			.content-block {
				padding: 0 0 20px;
			}

			.header {
				width: 100%;
				margin-bottom: 20px;
			}

			.footer {
				width: 100%;
				clear: both;
				color: #999;
				padding: 20px;
			}
			.footer a {
				color: #999;
			}
			.footer p, .footer a, .footer unsubscribe, .footer td {
				font-size: 12px;
			}

			/* -------------------------------------
				TYPOGRAPHY
			------------------------------------- */
			h1, h2, h3 {
				font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
				color: #000;
				margin: 40px 0 0;
				line-height: 1.2;
				font-weight: 400;
			}

			h1 {
				font-size: 32px;
				font-weight: 500;
			}

			h2 {
				font-size: 24px;
			}

			h3 {
				font-size: 18px;
			}

			h4 {
				font-size: 14px;
				font-weight: 600;
			}

			p, ul, ol {
				margin-bottom: 10px;
				font-weight: normal;
			}
			p li, ul li, ol li {
				margin-left: 5px;
				list-style-position: inside;
			}

			/* -------------------------------------
				LINKS & BUTTONS
			------------------------------------- */
			a {
				color: #48668e;
				text-decoration: underline;
			}

			.btn-primary {
				text-decoration: none;
				color: #FFF;
				background-color: #f6f6f6;
				border: solid #f6f6f6;
				border-width: 5px 10px;
				line-height: 2;
				font-weight: bold;
				text-align: center;
				cursor: pointer;
				display: inline-block;
				border-radius: 5px;
				text-transform: capitalize;
			}

			/* -------------------------------------
				OTHER STYLES THAT MIGHT BE USEFUL
			------------------------------------- */
			.last {
				margin-bottom: 0;
			}

			.first {
				margin-top: 0;
			}

			.aligncenter {
				text-align: center;
			}

			.alignright {
				text-align: right;
			}

			.alignleft {
				text-align: left;
			}

			.clear {
				clear: both;
			}

			/* -------------------------------------
				ALERTS
				Change the class depending on warning email, good email or bad email
			------------------------------------- */
			.alert {
				font-size: 16px;
				color: #fff;
				font-weight: 500;
				padding: 20px;
				text-align: center;
				border-radius: 3px 3px 0 0;
			}
			.alert a {
				color: #fff;
				text-decoration: none;
				font-weight: 500;
				font-size: 16px;
			}
			.alert.alert-warning {
				background: #f8ac59;
			}
			.alert.alert-bad {
				background: #ed5565;
			}
			.alert.alert-good {
				background: #f6f6f6;
			}

			/* -------------------------------------
				INVOICE
				Styles for the billing table
			------------------------------------- */
			.invoice {
				margin: 40px auto;
				text-align: left;
				width: 80%;
			}
			.invoice td {
				padding: 5px 0;
			}
			.invoice .invoice-items {
				width: 100%;
			}
			.invoice .invoice-items td {
				border-top: #eee 1px solid;
			}
			.invoice .invoice-items .total td {
				border-top: 2px solid #333;
				border-bottom: 2px solid #333;
				font-weight: 700;
			}

			/* -------------------------------------
				RESPONSIVE AND MOBILE FRIENDLY STYLES
			------------------------------------- */
			@media only screen and (max-width: 640px) {
				h1, h2, h3, h4 {
					font-weight: 600 !important;
					margin: 20px 0 5px !important;
				}

				h1 {
					font-size: 22px !important;
				}

				h2 {
					font-size: 18px !important;
				}

				h3 {
					font-size: 16px !important;
				}

				hr {height:1px; border:none; color:#000; background-color:#000;} 
				.container {
					width: 100% !important;
				}

				.content, .content-wrap {
					padding: 10px !important;
				}

				.invoice {
					width: 100% !important;
				}
			}
			.franja{background-color:#3b6082;height:3rem;}
		</style>';
	function password_reset_email($new_password = '' , $email = '')
	{
		$query = $this->db->get_where('users' , array('email' => $email));
		if($query->num_rows() > 0)
		{
			$adtionalmessagemail='';
			$linkmail='';
			$saludo='<b>Hola</b>';
			$cuerpo="<p>Tu contraseña ha sido cambiada. Tu nueva contraseña es : <strong style=''>".$new_password."</strong></span><br><div style='text-align:center'><a target='_blank' href='".get_settings('url_site')."'>Clic aquí para Ingresar</a></div><br><br>Saludos Cordiales.</p>";
			$email_sub	=	"Solicitud de restablecimiento de contraseña";
			$footer='<strong> '.get_settings('system_name').' </strong> | &copy; '.date('Y');
			$footer.=' <a href="'.get_settings('footer_link').'" target="_blank">'.get_settings('footer_text').'</a>';
			$message_body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>'.$email_sub.'</title>
		'.$this->estilos.'
	</head>
	<body>
	<table class="body-wrap">
	<tr>
	<td></td>
	<td class="container" width="600">
	<div class="content">
	<table class="main" width="100%" cellpadding="0" cellspacing="0">
	<tr>
	<td class="content-wrap">
	<table  cellpadding="0" cellspacing="0">
	<tr>
	<td>
	<img width="30%" class="img-responsive" src="'.site_url().'/assets/frontend/img/logo.png"/>
	</td>
	</tr>
	<tr><td><br><hr></td></tr>
	<tr>
	<td class="content-block">
	<h3>'.$saludo.'</h3>
	</td>
	</tr>
	<tr>
	<td class="content-block">
	'.$cuerpo.'
	</td>
	</tr>
	<tr>
	<td class="content-block">
	'.$adtionalmessagemail.'
	</td>
	</tr>
	<tr>
	<td class="content-block aligncenter">
	'.$linkmail.' 
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	<div class="footer">
	<table width="100%">
	<tr>
	<td class="aligncenter content-block">'.$footer.'.</td>
	</tr>
	</table>
	</div></div>
	</td>
	<td></td>
	</tr>
	</table>
	<div class="franja"></div>
	</body>
	</html>';
			$email_msg=$message_body;
			$email_to	=	$email;
			//$this->do_email($email_msg , $email_sub , $email_to);
			$this->send_smtp_mail($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{
			return false;
		}
	}
	/*Pago*/
function payment_success($body = '' , $email = '')
	{
		$query = $this->db->get_where('users' , array('email' => $email));
		if($query->num_rows() > 0)
		{
			$adtionalmessagemail='';
			$linkmail='';
			$saludo='';
			$cuerpo="<p>".$body."<br><br>Saludos Cordiales.</p>";
			$email_sub	=	"Gracias por tu compra";
			$footer='<strong> '.get_settings('system_name').' </strong> | &copy; '.date('Y');
			$footer.=' <a href="'.get_settings('footer_link').'" target="_blank">'.get_settings('footer_text').'</a>';
			$message_body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>'.$email_sub.'</title>
		'.$this->estilos.'
	</head>
	<body>
	<table class="body-wrap">
	<tr>
	<td></td>
	<td class="container" width="600">
	<div class="content">
	<table class="main" width="100%" cellpadding="0" cellspacing="0">
	<tr>
	<td class="content-wrap">
	<table  cellpadding="0" cellspacing="0">
	<tr>
	<td>
	<img width="30%" class="img-responsive" src="'.site_url().'/assets/frontend/img/logo.png"/>
	</td>
	</tr>
	<tr><td><br><hr></td></tr>
	<tr>
	<td class="content-block">
	<h3>'.$saludo.'</h3>
	</td>
	</tr>
	<tr>
	<td class="content-block">
	'.$cuerpo.'
	</td>
	</tr>
	<tr>
	<td class="content-block">
	'.$adtionalmessagemail.'
	</td>
	</tr>
	<tr>
	<td class="content-block aligncenter">
	'.$linkmail.' 
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	<div class="footer">
	<table width="100%">
	<tr>
	<td class="aligncenter content-block">'.$footer.'.</td>
	</tr>
	</table>
	</div></div>
	</td>
	<td></td>
	</tr>
	</table>
	<div class="franja"></div>
	</body>
	</html>';
			$email_msg=$message_body;
			$email_to	=	$email;
			//$this->do_email($email_msg , $email_sub , $email_to);
			$this->send_smtp_mail($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{
			return false;
		}
	}
	/*Pago*/
	public function send_email_verification_mail($to = "", $verification_code = "") {
		$redirect_url = site_url('login/verify_email_address/'.$verification_code);
		$subject 		= "Confirme su dirección de correo electrónico";
		$adtionalmessagemail='';
		$linkmail="<b><a href = ".$redirect_url." target = '_blank'>Clic aquí para verificar su dirección de correo</a></b>";
		$saludo='<b>Hola</b>';
		$cuerpo="<p>Por favor haga clic en el enlace de abajo para verificar su dirección de correo electrónico.</p><br><br>Saludos Cordiales.";
		$email_sub	=$subject;
		$footer='<strong> '.get_settings('system_name').' </strong> | &copy; '.date('Y');
		$footer.=' <a href="'.get_settings('footer_link').'" target="_blank">'.get_settings('footer_text').'</a>';
		$message_body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>'.$email_sub.'</title>
		'.$this->estilos.'
	</head>
	<body>
	<table class="body-wrap">
	<tr>
	<td></td>
	<td class="container" width="600">
	<div class="content">
	<table class="main" width="100%" cellpadding="0" cellspacing="0">
	<tr>
	<td class="content-wrap">
	<table  cellpadding="0" cellspacing="0">
	<tr>
	<td>
	<img width="30%" class="img-responsive" src="'.site_url().'/assets/frontend/img/logo.png"/>
	</td>
	</tr>
	<tr><td><br><hr></td></tr>
	<tr>
	<td class="content-block">
	<h3>'.$saludo.'</h3>
	</td>
	</tr>
	<tr>
	<td class="content-block">
	'.$cuerpo.'
	</td>
	</tr>
	<tr>
	<td class="content-block">
	'.$adtionalmessagemail.'
	</td>
	</tr>
	<tr>
	<td class="link content-block aligncenter">
	'.$linkmail.' 
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	<div class="footer">
	<table width="100%">
	<tr>
	<td class="aligncenter content-block">'.$footer.'.</td>
	</tr>
	</table>
	</div></div>
	</td>
	<td></td>
	</tr>
	</table>
	<div class="franja"></div>
	</body>
	</html>';
		$email_msg=$message_body;

		$this->send_smtp_mail($email_msg, $subject, $to);
	}

	public function send_mail_on_course_status_changing($course_id = "", $mail_subject = "", $mail_body = "") {
		$instructor_id		 = 0;
		$course_details    = $this->crud_model->get_course_by_id($course_id)->row_array();
		if ($course_details['user_id'] != "") {
			$instructor_id = $course_details['user_id'];
		}else {
			$instructor_id = $this->session->userdata('user_id');
		}
		$instuctor_details = $this->user_model->get_all_user($instructor_id)->row_array();
		$email_from = get_settings('system_email');

		$adtionalmessagemail='';
		$linkmail="";
		$saludo='';
		$footer='<strong> '.get_settings('system_name').' </strong> | &copy; '.date('Y');
		$footer.=' <a href="'.get_settings('footer_link').'" target="_blank">'.get_settings('footer_text').'</a>';
		$cuerpo=$mail_body;
		$email_sub	=$mail_subject;
		$message_body='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>'.$email_sub.'</title>
		'.$this->estilos.'
	</head>
	<body>
	<table class="body-wrap">
	<tr>
	<td></td>
	<td class="container" width="600">
	<div class="content">
	<table class="main" width="100%" cellpadding="0" cellspacing="0">
	<tr>
	<td class="content-wrap">
	<table  cellpadding="0" cellspacing="0">
	<tr>
	<td>
	<img width="30%" class="img-responsive" src="'.site_url().'/assets/frontend/img/logo.png"/>
	</td>
	</tr>
	<tr><td><br><hr></td></tr>
	<tr>
	<td class="content-block">
	<h3>'.$saludo.'</h3>
	</td>
	</tr>
	<tr>
	<td class="content-block">
	'.$cuerpo.'
	</td>
	</tr>
	<tr>
	<td class="content-block">
	'.$adtionalmessagemail.'
	</td>
	</tr>
	<tr>
	<td class="content-block aligncenter">
	'.$linkmail.' 
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	<div class="footer">
	<table width="100%">
	<tr>
	<td class="aligncenter content-block">'.$footer.'.</td>
	</tr>
	</table>
	</div></div>
	</td>
	<td></td>
	</tr>
	</table>
	</body>
	<div class="franja"></div>
	</html>';
		$mail_body=$message_body;
		$this->send_smtp_mail($mail_body, $mail_subject, $instuctor_details['email'], $email_from);
	}

	public function send_smtp_mail($msg=NULL, $sub=NULL, $to=NULL, $from=NULL) {
		//Load email library
		$this->load->library('email');

		if($from == NULL)
			$from		=	$this->db->get_where('settings' , array('key' => 'system_email'))->row()->value;

		//SMTP & mail configuration
		$config = array(
			'protocol'  => get_settings('protocol'),
			'smtp_host' => get_settings('smtp_host'),
			'smtp_port' => get_settings('smtp_port'),
			'smtp_user' => get_settings('smtp_user'),
			'smtp_pass' => get_settings('smtp_pass'),
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		//Email content
		// $htmlContent = '<h1>Sending email via SMTP server</h1>';
		// $htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';
		$htmlContent = $msg;

		$this->email->to($to);
		$this->email->from($from, get_settings('system_name'));
		$this->email->subject($sub);
		$this->email->message($htmlContent);
   // print_r($this->email);die;
		//Send email
		$this->email->send();
	}
}
