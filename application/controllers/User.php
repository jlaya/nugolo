<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Se incluye la libreria de Epayco
include APPPATH . 'vendor/autoload.php';

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->model('Announce_model');
        $this->load->model('Matriculation_model');
        $this->load->library('session');
        
        /*cache control*/
        //$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        //$this->output->set_header('Pragma: no-cache');
    }

    function getRealIP()
    {

        if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
            return $_SERVER["HTTP_FORWARDED"];
        }
        else
        {
            return $_SERVER["REMOTE_ADDR"];
        }

    }

    public function register_public() {

        $data['ref_payco'] = $this->input->get('ref_payco');
        $data['depart']    = $this->user_model->get_depart();
        $data['countries'] = $this->user_model->get_countries();
        $data['category']  = $this->user_model->get_category();
        $this->load->view('frontend/landingpage/index-public', $data);
    }

    public function register_private() {

        //$data['ref_payco'] = $this->input->get('ref_payco');
        $data['depart']    = $this->user_model->get_depart();
        $data['countries'] = $this->user_model->get_countries();
        $data['category']  = $this->user_model->get_category();
        $this->load->view('frontend/landingpage/index-private', $data);
    }

    public function provincia_ciudad() {
        $cod = $this->input->post('cod');
        $result = $this->user_model->provincia_ciudad( $cod );
        echo json_encode( $result );
    }

    public function index() {

        if( $this->session->userdata('user_id') ){
            $page_data['page_name']  = "";
            $page_data['page_title'] = get_phrase('home');
            if(!$this->session->userdata('user_id')){
                redirect(site_url('/'), 'refresh');
            }
            return $this->load->view('frontend/default/homePropuesta', $page_data );
        }else{
            $page_data['page_name'] = "home-landingpage";
        }
        $page_data['page_title'] = get_phrase('home');
        $this->load->view('frontend/default/index-landigpage', $page_data);
    }

    public function ajax_sub_category() {
        $id = $this->input->post('id');
        $result = $this->user_model->ajax_sub_category( $id );
        echo json_encode( $result );
    }

    public function validate_login( $data ) {
        $this->load->library('session');
      $email = $data['email'];
      $password = $data['password'];
      $credential = array('email' => $email, 'password' => $password);

      // Checking login credential for admin
      $query = $this->db->get_where('users', $credential);

          if ($query->num_rows() > 0) {
            $row = $query->row();

            $this->session->set_userdata('user_id', $row->id);
            $this->session->set_userdata('role_id', $row->role_id);
            $this->session->set_userdata('role', get_user_role('user_role', $row->id));
            $this->session->set_userdata('name', $row->first_name.' '.$row->last_name);
            redirect(site_url('home'), 'refresh');
        }else {
            $this->session->set_flashdata('error_message',get_phrase('invalid_login_credentials'));
            if ($from == "user")
              redirect(site_url('home'), 'refresh');
            else
              redirect(site_url('login'), 'refresh');

        }

    }

    public function register() {
        
        //$SECRET_KEY = '6LfwdMUZAAAAAH6nWk0FiN0BisBtxgv4oyM_HKjD';
        //print_r($this->input->post()); exit;
        //$data['recaptcha_token'] = html_escape($this->input->post('g-recaptcha-response'));
        //$data['recaptcha_token'] = '123456';
        //$googleToken = $data['recaptcha_token'];
        //$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$SECRET_KEY."&response={$googleToken}");
        //$response = json_decode($response);
        //$response = (array) $response;
        //print_r($response); exit;
        //if( $response['success'] == 1 )
        //{
           $uri_string          = $this->input->post('uri_string');
           $data['first_name']  = html_escape($this->input->post('first_name'));
            $data['last_name']  = html_escape($this->input->post('last_name'));
            $data['email']      = html_escape($this->input->post('email'));
            $data['nivel']   = html_escape($this->input->post('nivel'));
            $data['date_nac']   = html_escape($this->input->post('date_nac'));
            $data['password']   = sha1($this->input->post('password'));

            $verification_code =  md5(rand(100000000, 200000000));
            $data['verification_code'] = $verification_code;
            //$data['status'] = 1;
            /*if( $this->input->post('pay') == 1 ){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }*/
            $data['status'] = 1;
            $data['wishlist'] = json_encode(array());
            $data['watch_history'] = json_encode(array());
            $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
            $social_links = array(
                'facebook' => "",
                'twitter'  => "",
                'linkedin' => ""
            );
            $data['social_links'] = json_encode($social_links);
            $data['role_id']  = 2;

            // Add paypal keys
            $paypal_info = array();
            $paypal['production_client_id'] = "";
            array_push($paypal_info, $paypal);
            $data['paypal_keys'] = json_encode($paypal_info);
            // Add Stripe keys
            $stripe_info = array();
            $stripe_keys = array(
                'public_live_key' => "",
                'secret_live_key' => ""
            );
            array_push($stripe_info, $stripe_keys);
            $data['stripe_keys'] = json_encode($stripe_info);

            $validity = $this->user_model->check_duplication('on_create', $data['email']);
            if ($validity) {
                $user_id = $this->user_model->register_user($data);
                //echo $this->db->last_query();

                // Ingreso de detalles de valoracion
                /*$detail_u['user_id']         = $user_id;
                $detail_u['gender']          = $this->input->post('gender');
                $detail_u['age']             = $this->input->post('age');
                $detail_u['contact']         = $this->input->post('contact');
                $detail_u['weighing']        = $this->input->post('weighing');
                $detail_u['stature']         = $this->input->post('stature');
                $detail_u['type_activity']   = $this->input->post('type_activity');
                $detail_u['frequency']       = $this->input->post('frequency');
                $detail_u['schedule']        = $this->input->post('schedule');
                $detail_u['phone']           = $this->input->post('phone');
                $detail_u['category_id']     = $this->input->post('category_id');
                $detail_u['pathology']       = $this->input->post('pathology');
                $detail_u['depart']          = $this->input->post('depart');
                $detail_u['city']            = $this->input->post('city');
                $detail_u['address']         = $this->input->post('address');
                $detail_u['pay']             = $this->input->post('pay');
                $detail_u['ref_payco']       = $this->input->post('ref_payco');
                $detail_u['countries']       = $this->input->post('countries');
                $detail_u['date_created']    = date("Y-m-d");*/
                

                if($user_id){
                    $this->session->set_flashdata('flash_message', 'Se ha registrado con exito');

                    /*if( $detail_u['pay'] == 1 ){
                        $detail_u['day'] = 30;
                    }*/

                }
                
                #$this->user_model->register_user_detail($detail_u);

                // set array of items in session
                $arraydata = array(
                        'client_id'  => $user_id
                );
                $this->session->set_userdata($arraydata);

                //echo $this->db->last_query();
                /*$this->session->set_userdata('user_login', '1');
                $this->session->set_userdata('user_id', $user_id);
                $this->session->set_userdata('role_id', 2);
                $this->session->set_userdata('role', get_user_role('user_role', 2));
                $this->session->set_userdata('name', $data['first_name'].' '.$data['last_name']);*/
                /*$ma=$this->email_model->send_email_verification_mail($data['email'], $verification_code);
                // echo $this->email->print_debugger();
                if($ma){
                    
                $this->session->set_flashdata('flash_message', 'Se envio un correo a su bandeja de entrada');
                    
                }*/
            }else {
                $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
            }
        //}

        
        #redirect(site_url('home/courses?pay='.$this->input->post('pay')), 'refresh');

        $validate = array(
            'email'      => $data['email'],
            'password'   => $data['password'],
            'uri_string' => $uri_string
        );

        $this->validate_login( $validate );
    }

    public function registers_private() {
        
        //$SECRET_KEY = '6LfwdMUZAAAAAH6nWk0FiN0BisBtxgv4oyM_HKjD';
        //print_r($this->input->post()); exit;
        //$data['recaptcha_token'] = html_escape($this->input->post('g-recaptcha-response'));
        //$data['recaptcha_token'] = '123456';
        //$googleToken = $data['recaptcha_token'];
        //$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$SECRET_KEY."&response={$googleToken}");
        //$response = json_decode($response);
        //$response = (array) $response;
        //print_r($response); exit;
        //if( $response['success'] == 1 )
        //{
           $data['first_name'] = html_escape($this->input->post('first_name'));
            $data['last_name']  = html_escape($this->input->post('last_name'));
            $data['email']  = html_escape($this->input->post('email'));
            $data['password']  = sha1($this->input->post('password'));

            $verification_code =  md5(rand(100000000, 200000000));
            $data['verification_code'] = $verification_code;
            $data['status'] = 0;
            $data['wishlist'] = json_encode(array());
            $data['watch_history'] = json_encode(array());
            $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
            $social_links = array(
                'facebook' => "",
                'twitter'  => "",
                'linkedin' => ""
            );
            $data['social_links'] = json_encode($social_links);
            $data['role_id']  = 2;

            // Add paypal keys
            $paypal_info = array();
            $paypal['production_client_id'] = "";
            array_push($paypal_info, $paypal);
            $data['paypal_keys'] = json_encode($paypal_info);
            // Add Stripe keys
            $stripe_info = array();
            $stripe_keys = array(
                'public_live_key' => "",
                'secret_live_key' => ""
            );
            array_push($stripe_info, $stripe_keys);
            $data['stripe_keys'] = json_encode($stripe_info);

            $validity = $this->user_model->check_duplication('on_create', $data['email']);
            if ($validity) {
                $user_id = $this->user_model->register_user($data);
                //echo $this->db->last_query();

                // Ingreso de detalles de valoracion
                $detail_u['user_id']         = $user_id;
                $detail_u['gender']          = $this->input->post('gender');
                $detail_u['age']             = $this->input->post('age');
                $detail_u['contact']         = $this->input->post('contact');
                $detail_u['weighing']        = $this->input->post('weighing');
                $detail_u['stature']         = $this->input->post('stature');
                $detail_u['type_activity']   = $this->input->post('type_activity');
                $detail_u['frequency']       = $this->input->post('frequency');
                $detail_u['schedule']        = $this->input->post('schedule');
                $detail_u['phone']           = $this->input->post('phone');
                $detail_u['category_id']     = $this->input->post('category_id');
                $detail_u['pathology']       = $this->input->post('pathology');
                $detail_u['depart']          = $this->input->post('depart');
                $detail_u['city']            = $this->input->post('city');
                $detail_u['address']         = $this->input->post('address');
                $detail_u['pay']             = $this->input->post('pay');
                $detail_u['ref_payco']       = $this->input->post('ref_payco');
                $detail_u['countries']       = $this->input->post('countries');
                $detail_u['date_created']    = date("Y-m-d");
                

                if($user_id){
                    $this->session->set_flashdata('flash_message', 'Se ha registrado con exito');

                    if( $detail_u['pay'] == 1 ){
                        $detail_u['day'] = 30;
                    }

                }
                
                $this->user_model->register_user_detail($detail_u);

                // set array of items in session
                $arraydata = array(
                        'client_id'  => $user_id
                );
                $this->session->set_userdata($arraydata);

                //echo $this->db->last_query();
                /*$this->session->set_userdata('user_login', '1');
                $this->session->set_userdata('user_id', $user_id);
                $this->session->set_userdata('role_id', 2);
                $this->session->set_userdata('role', get_user_role('user_role', 2));
                $this->session->set_userdata('name', $data['first_name'].' '.$data['last_name']);*/
                /*$ma=$this->email_model->send_email_verification_mail($data['email'], $verification_code);
                // echo $this->email->print_debugger();
                if($ma){
                    
                $this->session->set_flashdata('flash_message', 'Se envio un correo a su bandeja de entrada');
                    
                }*/
            }else {
                $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
            }
        //}

        
        redirect(site_url('register_private?pay='.$this->input->post('pay')), 'refresh');
    }

    public function preview_users() {

        $this->load->library('session');

        $data = $this->input->post();

        $this->session->set_userdata( 'users', $data );

    }

    public function register_preview_users() {

        $forms         = $this->session->userdata['users'];
        $first_name    = $forms['first_name'];
        $last_name     = $forms['last_name'];
        $email         = $forms['email'];
        $phone         = $forms['phone'];
        $password      = $forms['password'];
        $gender        = $forms['gender'];
        $age           = $forms['age'];
        $contact       = $forms['contact'];
        $weighing      = $forms['weighing'];
        $stature       = $forms['stature'];
        $type_activity = $forms['type_activity'];
        $frequency     = $forms['frequency'];
        $schedule      = $forms['schedule'];
        $category_id   = $forms['category_id'];
        $pathology     = $forms['pathology'];
        $pay           = $forms['pay'];


        $data['first_name'] = html_escape($first_name);
        $data['last_name']  = html_escape($last_name);
        $data['email']  = html_escape($email);
        $data['password']  = sha1($password);

        $verification_code =  md5(rand(100000000, 200000000));
        $data['verification_code'] = $verification_code;
        $data['status'] = 0;
        $data['wishlist'] = json_encode(array());
        $data['watch_history'] = json_encode(array());
        $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
        $social_links = array(
            'facebook' => "",
            'twitter'  => "",
            'linkedin' => ""
        );
        $data['social_links'] = json_encode($social_links);
        $data['role_id']  = 2;

        // Add paypal keys
        $paypal_info = array();
        $paypal['production_client_id'] = "";
        array_push($paypal_info, $paypal);
        $data['paypal_keys'] = json_encode($paypal_info);
        // Add Stripe keys
        $stripe_info = array();
        $stripe_keys = array(
            'public_live_key' => "",
            'secret_live_key' => ""
        );
        array_push($stripe_info, $stripe_keys);
        $data['stripe_keys'] = json_encode($stripe_info);

        $validity = $this->user_model->check_duplication('on_create', $email);
        if ($validity) {
            $user_id = $this->user_model->register_user($data);

            // Ingreso de detalles de valoracion
            $detail_u['user_id']         = $user_id;
            $detail_u['gender']          = $gender;
            $detail_u['age']             = $age;
            $detail_u['contact']         = $contact;
            $detail_u['weighing']        = $weighing;
            $detail_u['stature']         = $stature;
            $detail_u['type_activity']   = $type_activity;
            $detail_u['frequency']       = $frequency;
            $detail_u['schedule']        = $schedule;
            $detail_u['phone']           = $phone;
            $detail_u['category_id']     = $category_id;
            $detail_u['pathology']       = $pathology;
            $detail_u['pay']             = $pay;
            $detail_u['state']           = 1;
            $detail_u['ref_payco']       = $this->input->post('ref_payco');
            $this->user_model->register_user_detail($detail_u);

            if($user_id){
                $this->session->set_flashdata('flash_message', 'Se ha registrado con exito');
            }

            /*$this->session->set_userdata('user_login', '1');
            $this->session->set_userdata('user_id', $user_id);
            $this->session->set_userdata('role_id', 2);
            $this->session->set_userdata('role', get_user_role('user_role', 2));
            $this->session->set_userdata('name', $data['first_name'].' '.$data['last_name']);*/
            /*$ma=$this->email_model->send_email_verification_mail($email, $verification_code);
            // echo $this->email->print_debugger();
            if($ma){
                
            $this->session->set_flashdata('flash_message', 'Se envio un correo a su bandeja de entrada');
                
            }*/
        }else {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        }
        
        // Se destruye los datos en sesion
        $this->session->unset_userdata('users');
        //redirect(site_url('/'), 'refresh');
    }


    // Contador de dias segun cada estudiante
    public function counter_student(){

        //echo "Se evaluan los datos";
        //exit;

        $date_now     = date("Y-m-d");
        $user_id      = $this->session->userdata('user_id');
        $this->db->where('a.user_id', $user_id);
        $this->db->select("a.id,a.day,a.date_created");
        $obj          = $this->db->get('users_detail AS a')->row();
        $id           = $obj->id;
        $day          = $obj->day;
        $date_created = $obj->date_created;

        if( $date_now == $date_created ){
            //echo "Son iguales, se procede a su validacion<br>";
            $day_update = --$day;
            if( $day != -1 ){
                $this->db->where( 'id' , $id );
                $this->db->update('users_detail',  array( 
                    'day'          => $day_update, 
                    'date_created' => date("Y-m-d", strtotime("+1 day")), 
                ) );

                echo json_encode( $day_update );
            }
        }

        // Se comprueba si llega el limite de dias a Cero(0)
        // se reinicia el contador a 30 dias para que el ciclo
        // haga su trabajo de nuevo.
        if( $day == 0 ){

            $this->db->where( 'id' , $user_id );
            $this->db->update('users',  array( 
                'status'    => 0
            ) );

            $this->db->where( 'id' , $id );
            $this->db->update('users_detail',  array( 
                'pay'    => 0
            ) );

        }

    }

    // Contador de dias segun cada estudiante de modo automatico
    public function counter_student_ready(){

        $date_now     = date("Y-m-d");
        $this->db->where('a.date_created <>', null);
        $this->db->select("a.id,a.day,a.user_id,a.date_created");
        $obj          = $this->db->get('users_detail AS a')->result();
        foreach ($obj as $key => $value) {
            $id           = $value->id;
            $user_id      = $value->user_id;
            $day          = $value->day;
            $date_created = $value->date_created;

            if( $date_now == $date_created ){
                //echo "Son iguales, se procede a su validacion<br>";
                $day_update = --$day;
                if( $day != -1 ){
                    $this->db->where( 'id' , $id );
                    $this->db->update('users_detail',  array( 
                        'day'          => $day_update, 
                        'date_created' => date("Y-m-d", strtotime("+1 day")), 
                    ) );

                    echo json_encode( $day_update );
                }
            }

            // Se comprueba si llega el limite de dias a Cero(0)
            // se reinicia el contador a 30 dias para que el ciclo
            // haga su trabajo de nuevo.
            if( $day == 0 ){

                $this->db->where( 'id' , $id );
                $this->db->where( 'day' , 0 );
                $this->db->select("a.user_id");
                $obj_u = $this->db->get('users_detail AS a')->row();

                $this->db->where( 'id' , $obj_u->user_id );
                $this->db->where( 'role_id' , 2 );
                $this->db->update('users',  array( 
                    'status'    => 0
                ) );

                $this->db->where( 'id' , $id );
                $this->db->where( 'day' , 0 );
                $this->db->update('users_detail',  array( 
                    'pay'    => 0
                ) );

            }
        }

    }

    public function cron_example(){

        $this->db->where( 'id' , 1 );
        $this->db->update('cron',  array( 
            'name'    => "Se ejecuto: ".date("Y-m-d H:i:s")
        ) );

    }

}
