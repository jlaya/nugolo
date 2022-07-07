<?php
ini_set('error_reporting', 'off');
ini_set('display_errors', 'off');
error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        // Load models
        $this->load->model('Question_model');
    }

    /**
    / Encuesta info
    */

    public function index() {
        $data['obj'] = $this->Question_model->show();
        $this->load->view('backend/admin/question/index', $data);
    }

    /**
    / Encuesta info Respuestas
    */

    public function pull_response() {
        $data['page_title'] = 'Respuestas';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['obj'] = $this->Question_model->pull_response();
        $this->load->view('backend/psicologo/pull_response', $data);
    }

    public function ajax_pull() {
        
        $user_id = $this->input->post('user_id');
        $json    = $this->Question_model->ajax_pull( $user_id );
        echo json_encode($json);
    }

    public function detail( $id ) {
        $data['detail'] = $this->Question_model->detail( $id );
        $data['obj'] = $this->Question_model->show();
        $this->load->view('backend/admin/question/index', $data);
    }

    public function save() {

        $data['id']           = html_escape($this->input->post('id'));
        $data['title']        = html_escape($this->input->post('title'));
        $data['description']  = html_escape($this->input->post('description'));
        
        $this->Question_model->save($data);
        
        redirect(site_url('/Question'), 'refresh');
    }

    public function delete( $id ) {
        
        $result = $this->Question_model->delete( $id );
        if( $result == 'exists' ){
            $message = "No se puede eliminar, se encuentra asociado a un cuestionario";
            echo "<script>alert('$message')</script>";
        }else{
            $message = "";
        }
        
        redirect(site_url('/Question'), 'refresh');
    }
    /**
    / Encuesta
    */
    public function question( $id ) {
        $data['id']  = $id;
        $data['obj'] = $this->Question_model->question( $id );
        $this->load->view('backend/admin/question/question', $data );
    }

    public function detail_question( $id ) {
        $data['detail'] = $this->Question_model->detail_question( $id );
        $data['obj']    = $this->Question_model->question( $id );
        $this->load->view('backend/admin/question/question', $data );
    }

    public function delete_question( $question_info_id, $id ) {
        
        $result = $this->Question_model->delete_question( $id );
        if( $result == 'exists' ){
            $message = "No se puede eliminar, se encuentra asociado a una encuesta";
            echo "<script>alert('$message')</script>";
        }else{
            $message = "";
        }
        
        redirect(site_url('/Question/question/'.$question_info_id), 'refresh');
    }

    public function save_question() {

        $data['id']               = html_escape($this->input->post('id'));
        $data['question_info_id'] = html_escape($this->input->post('question_info_id'));
        $data['question']         = html_escape($this->input->post('question'));
        $data['required']         = html_escape($this->input->post('required'));
        $data['type']             = html_escape($this->input->post('type'));
        $data['value']            = html_escape($this->input->post('values'));
        $data['length']           = html_escape($this->input->post('length'));
        $data['video']            = html_escape($this->input->post('video'));
        
        $this->Question_model->save_question($data);
        
        redirect(site_url('/Question/question/'.$data['question_info_id'] ), 'refresh');
    }

    public function add_pull() {

        $inputs = $this->input->post();
        $data['form'] = $inputs['form'];

        //echo "<pre>";
        //print_r($inputs);
        // Key id
        foreach ($inputs['id'] as $key => $ids) {
            $id = $ids;
            $data['question_id'] = $id;
            // Key checkbox
            $value_checkbox = "";
            foreach ($inputs["checkbox_$ids"] as $key => $checkbox) {
                $value_checkbox .= $checkbox.",";
            }
             $data['response'] = $value_checkbox = substr($value_checkbox, 0, -1);
            // Key input
            foreach ($inputs["input_$ids"] as $key => $input) {
                $value_input = $input;
                $data['response'] = $value_input;
            }
            // Key radio
            foreach ($inputs["radio_$ids"] as $key => $radio) {
                $value_radio = $radio;
                $data['response'] = $value_radio;
            }
            // Registro de datos
            $this->Question_model->add_pull($data);
        }

        redirect(base_url('home'));

    }

    public function update_pull() {

        $inputs = $this->input->post();
        //$data['form'] = $inputs['form'];

        //echo "<pre>";
        //print_r($inputs);
        // Key id
        foreach ($inputs['id'] as $key => $ids) {
            $id = $ids;
            
            // Key checkbox
            $value_checkbox = "";
            foreach ($inputs["checkbox_$ids"] as $key => $checkbox) {
                $value_checkbox .= $checkbox.",";
            }
             //$data['response'] = $value_checkbox = substr($value_checkbox, 0, -1);
            // Key input
            foreach ($inputs["input_$ids"] as $key => $input) {
                $value_input = $input;
                $data['response'] = $value_input;
            }
            // Key radio
            foreach ($inputs["radio_$ids"] as $key => $radio) {
                $value_radio = $radio;
                $data['response'] = $value_radio;
            }
            // Actualizacion de datos
            $this->Question_model->update_pull( $id, $data );
            //echo $this->db->last_query()."<br>";

        }

        redirect(base_url('home'));

    }


}
