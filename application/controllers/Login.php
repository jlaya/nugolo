<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        
        /*cache control*/
        //$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        //$this->output->set_header('Pragma: no-cache');
    }

    public function index() {
        //$this->load->library('session');
        if ($this->session->userdata('admin_login') == true) {
            redirect(site_url('admin/dashboard'), 'refresh');
        }else {
            $this->load->view('backend/login.php');
        }
    }


    // Logro por (logro por conectarse 1 semana)
    public function connection_users( $user_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('ci_sessions_users AS a');
        $this->db->where('a.user_id', $user_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function filter_type( $type, $user_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('history_logros AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.type', $type);
        $query = $this->db->get();
        return $query->row();
    }

    public function validate_login($from = "") {
      $this->load->library('session');
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $credential = array('email' => $email, 'password' => sha1($password), 'status' => 1);

      // Checking login credential for admin
      $query = $this->db->get_where('users', $credential);

          if ($query->num_rows() > 0) {
            $row = $query->row();

            // Logro por (logro por conectarse 1 semana)

            if( $row->role_id == 2 ){
                $ci_sessions_users['user_id'] = $row->id;
                $ci_sessions_users['ip']      = $this->input->ip_address();
                $this->db->insert('ci_sessions_users', $ci_sessions_users);

                $connection_users = $this->connection_users( $row->id )->can;
                // Coneccion para 1 semana
                $filter_type_15 = $this->filter_type( 15, $row->id )->can;

                if( $filter_type_15 == 0 && $connection_users == 7 ){
                    $history_logros['user_id']   = $row->id;
                    $history_logros['course_id'] = 0;
                    $history_logros['lesson_id'] = 0;
                    $history_logros['type']      = 15;
                    $this->db->insert('history_logros', $history_logros);
                }

                // Coneccion para 2 semana
                $filter_type_16 = $this->filter_type( 16, $row->id )->can;

                if( $filter_type_16 == 0 && $connection_users == 14 ){
                    $history_logros['user_id']   = $row->id;
                    $history_logros['course_id'] = 0;
                    $history_logros['lesson_id'] = 0;
                    $history_logros['type']      = 16;
                    $this->db->insert('history_logros', $history_logros);
                }

                // Coneccion para 1 mes
                $filter_type_17 = $this->filter_type( 17, $row->id )->can;

                if( $filter_type_17 == 0 && $connection_users == 31 ){
                    $history_logros['user_id']   = $row->id;
                    $history_logros['course_id'] = 0;
                    $history_logros['lesson_id'] = 0;
                    $history_logros['type']      = 17;
                    $this->db->insert('history_logros', $history_logros);
                }

            }

            $this->session->set_userdata('user_id', $row->id);
            $this->session->set_userdata('role_id', $row->role_id);
            $this->session->set_userdata('role', get_user_role('user_role', $row->id));
            $this->session->set_userdata('name', $row->first_name.' '.$row->last_name);
            if ( $row->role_id == 1 ) {
               $this->session->set_userdata('admin_login', '1');
               redirect(site_url('admin/dashboard'), 'refresh');
            }else if( $row->role_id == 2 ){
               $this->session->set_userdata('user_login', '1');
               redirect(site_url('home'), 'refresh');
            }else if ( $row->role_id == 3 ) {
               $this->session->set_userdata('admin_login', '1');
               redirect(site_url('admin/dashboard'), 'refresh');
            }else if ( $row->role_id == 4 ) {
               $this->session->set_userdata('admin_login', '1');
               redirect(site_url('admin/dashboard'), 'refresh');
            }else if ( $row->role_id == 5 ) {
               $this->session->set_userdata('admin_login', '1');
               redirect(site_url('admin/dashboard'), 'refresh');
            }else if ( $row->role_id == 6 ) {
               $this->session->set_userdata('admin_login', '1');
               redirect(site_url('admin/dashboard'), 'refresh');
            }
        }else {
            $this->session->set_flashdata('error_message',get_phrase('invalid_login_credentials'));
            if ($from == "user")
              redirect(site_url('home'), 'refresh');
            else
              redirect(site_url('login'), 'refresh');

        }

    }

    public function register() {
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
            /*$this->session->set_userdata('user_login', '1');
            $this->session->set_userdata('user_id', $user_id);
            $this->session->set_userdata('role_id', 2);
            $this->session->set_userdata('role', get_user_role('user_role', 2));
            $this->session->set_userdata('name', $data['first_name'].' '.$data['last_name']);*/
            /*$ma=$this->email_model->send_email_verification_mail($data['email'], $verification_code);
            // echo $this->email->print_debugger();
            if($ma){
                
            $this->session->set_flashdata('flash_message', get_phrase('your_registration_has_been_successfully_done').'. '.get_phrase('please_check_your_mail_inbox_to_verify_your_email_address').'.');
                
            }else{
               // var_dump($ma);
                 //print_r($ma);die;
                $this->session->set_flashdata('flash_message', get_phrase('your_registration_has_been_successfully_done').'.*--* '.get_phrase('please_check_your_mail_inbox_to_verify_your_email_address'));
            }*/
        }else {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        }
        if(count($this->session->userdata('cart_items'))>0){
            $this->session->set_userdata('user_id', $user_id);
            $this->session->set_userdata('user_login', '1');
            $this->session->set_userdata('levanta_modal', '1');
            redirect(site_url('home/shopping_cart'), 'refresh');
        }else{
            redirect(site_url('home'), 'refresh');
        }
    }

    public function logout($from = "") {
      //destroy sessions of specific userdata. We've done this for not removing the cart session
      $this->session_destroy();

      if ($from == "user")
        redirect(site_url('home'), 'refresh');
      else
        redirect(site_url('login'), 'refresh');
    }

    public function session_destroy() {
        $this->load->library('session');
      $this->session->unset_userdata('user_id');
      $this->session->unset_userdata('role_id');
      $this->session->unset_userdata('role');
      $this->session->unset_userdata('name');
      if ($this->session->userdata('admin_login') == 1) {
        $this->session->unset_userdata('admin_login');
      }else {
        $this->session->unset_userdata('user_login');
      }
    }

    function forgot_password($from = "") {
        $email = $this->input->post('email');
        //resetting user password here
        $new_password = substr( md5( rand(100000000,20000000000) ) , 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('users' , array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $this->db->where('email' , $email);
            $this->db->update('users' , array('password' => sha1($new_password)));
            // send new password to user email
            $this->email_model->password_reset_email($new_password, $email);
            $this->session->set_flashdata('flash_message', get_phrase('please_check_your_email_for_new_password'));
            if ($from == 'backend') {
                redirect(site_url('login'), 'refresh');
            }else {
                redirect(site_url('home'), 'refresh');
            }
        }else {
            $this->session->set_flashdata('error_message', 'Usted no se encuentra en la plataforma, debe registrarse primero');
            if ($from == 'backend') {
                redirect(site_url('login'), 'refresh');
            }else {
                redirect(site_url('home'), 'refresh');
            }
        }
    }

    public function verify_email_address($verification_code = "") {
        $user_details = $this->db->get_where('users', array('verification_code' => $verification_code));
        if($user_details->num_rows() == 0) {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        }else {
            $user_details = $user_details->row_array();
            $updater = array(
                'status' => 1
            );
            $this->db->where('id', $user_details['id']);
            $this->db->update('users', $updater);
            $this->session->set_flashdata('flash_message', get_phrase('congratulations').'!'.get_phrase('your_email_address_has_been_successfully_verified').'.');
        }
        redirect(site_url('home'), 'refresh');
    }
}
