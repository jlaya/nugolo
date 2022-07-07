<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Confirmation extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        // Load models
        $this->load->model('Confirmation_model');
    }

    /**
    / Detalles de la transaccion al momento de la carga de la informacion
    */
    public function get_data_users(){
        $this->load->library('session');
        $data = $this->input->post();
        print_r($data);
        $this->session->set_userdata( 'users', $data );
    }

    /**
    / Detalles de la transaccion al momento de la carga de la informacion
    */
    public function get_show_users(){
        $this->load->library('session');
        $forms = $this->session->userdata['users'];
        //print_r($forms);
        //echo json_encode($data);
        //$SECRET_KEY = '6LfwdMUZAAAAAH6nWk0FiN0BisBtxgv4oyM_HKjD';
        //print_r($this->input->post()); exit;
        //$data['recaptcha_token'] = $forms['g-recaptcha-response'];
        //$data['recaptcha_token'] = '123456';
        //$googleToken = $data['recaptcha_token'];
        //$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$SECRET_KEY."&response={$googleToken}");
        //$response = json_decode($response);
        //$response = (array) $response;
        //print_r($response); exit;
        //if( $response['success'] == 1 )
        //{
           $data['first_name'] = html_escape($forms['first_name']);
            $data['last_name']  = html_escape($forms['last_name']);
            $data['email']  = html_escape($forms['email']);
            $data['password']  = sha1($forms['password']);

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
                $detail_u['gender']          = $forms['gender'];
                $detail_u['age']             = $forms['age'];
                $detail_u['contact']         = $forms['contact'];
                $detail_u['weighing']        = $forms['weighing'];
                $detail_u['stature']         = $forms['stature'];
                $detail_u['type_activity']   = $forms['type_activity'];
                $detail_u['frequency']       = $forms['frequency'];
                $detail_u['schedule']        = $forms['schedule'];
                $detail_u['phone']           = $forms['phone'];
                $detail_u['category_id']     = $forms['category_id'];
                $detail_u['pathology']       = $forms['pathology'];
                $detail_u['city']            = $forms['city'];
                $detail_u['address']         = $forms['address'];
                $detail_u['pay']             = $forms['pay'];
                $detail_u['ref_payco']       = $this->input->post('ref_payco');
                //$detail_u['doc_number']      = $this->input->post('doc_number');
                

                if($user_id){
                    $this->session->set_flashdata('flash_message', 'Se ha registrado con exito');

                    if( $detail_u['pay'] == 1 ){
                        //$detail_u['response'] = json_encode($pse);
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
                $ma=$this->email_model->send_email_verification_mail($data['email'], $verification_code);
                // echo $this->email->print_debugger();
                if($ma){
                    
                $this->session->set_flashdata('flash_message', 'Se envio un correo a su bandeja de entrada');
                    
                }
            }else {
                $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
            }
        //}
    }

    /**
    / Detalles de la transaccion
    */

    public function details() {
        $data['page_title'] = 'Consulta';
        $data['ref_payco']  = $this->input->get('ref_payco');
        $this->load->view('frontend/landingpage/confirm', $data);
    }

    /**
    / Encuesta info
    */

    public function index() {
        $data['page_title'] = 'Confirmación';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['obj'] = $this->Confirmation_model->show();
        $this->load->view('backend/admin/confirmation', $data);
    }

    public function send( $model_id, $user_id ) {

        $this->Confirmation_model->send( $model_id , $user_id );

        redirect(base_url("Confirmation"));
    }

    // forma de validar las tareas de cada usuario Estudiante
    public function is_checked() {

        $id         = $this->input->post('id');
        $is_checked = $this->input->post('is_checked');

        $this->Confirmation_model->is_checked( $id, $is_checked );

    }


}
