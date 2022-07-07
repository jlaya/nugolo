<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insignias extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Insignias_model');
    }

    public function index( $data = [] ) {
        $data['page_title'] = 'Insignias';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['obj'] = $this->Insignias_model->show();
        $this->load->view('backend/insignias/index', $data );
    }

    public function new() {

        $data['role_id'] = $this->session->userdata('role_id');
        $data['page_title'] = 'Crear nueva Insignias';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $this->load->view('backend/insignias/add' , $data );
    }

    public function add() {

        $course_ids           = $this->input->post('course_ids');
        $data['id']           = $this->input->post('id');
        $data['course_ids']   = implode(',', $course_ids);
        $data['name']         = $this->input->post('name');
        $data['valorCoin']    = $this->input->post('valorCoin');
        $data['valorExp']     = $this->input->post('valorExp');
        $data['date_created'] = date('Y-m-d');
        if ($_FILES['avatar']['name'] != ""):
            $archivo = $_FILES['avatar']['name'];
            $ex      = explode('.', $archivo);
            $ex      = $ex[1]; // Extencion
            $archivo = 'icon-'.$this->input->post('name') . "." . $ex;
            $ruta    = getcwd();  // Obtiene el directorio actual
            move_uploaded_file($_FILES['avatar']['tmp_name'], $ruta . "/assets/backend/insignias/" . $archivo);
            $data['avatar'] = $archivo;
        endif;
        $object = $this->Insignias_model->add($data);
        redirect(site_url('insignias'), 'refresh');
    }

    public function edit( $id ) {

        $data['role_id'] = $this->session->userdata('role_id');
        $data['page_title'] = 'Editar insignias';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['edit'] = $this->Insignias_model->detail( $id );
        $this->load->view('backend/insignias/update', $data );
    }

    public function update() {

        if ($_FILES['avatar']['name'] != ""):
            $archivo = $_FILES['avatar']['name'];
            $ex      = explode('.', $archivo);
            $ex      = $ex[1]; // Extencion
            $archivo = 'icon-'.$this->input->post('name') . "." . $ex;
            $ruta    = getcwd();  // Obtiene el directorio actual
            move_uploaded_file($_FILES['avatar']['tmp_name'], $ruta . "/assets/backend/insignias/" . $archivo);
            $data['avatar'] = $archivo;
        endif;

        $data['id']           = $this->input->post('id');
        $data['name']         = $this->input->post('name');
        $data['valorCoin']    = $this->input->post('valorCoin');
        $data['valorExp']     = $this->input->post('valorExp');
        $course_ids           = $this->input->post('course_ids');
        $data['course_ids']   = implode(',', $course_ids);
        $data['date_created'] = date('Y-m-d');
        $this->Insignias_model->add($data);
        redirect(site_url('insignias'), 'refresh');
    }

    public function delete( $id ) {

        $result = $this->Insignias_model->delete( $id );
        if( $result ){
            $data['message'] = "Se ha eliminado la insignia";
        }
        redirect(site_url('insignias'), 'refresh');
    }

    public function ajax_insignias(){

        $json = $this->Insignias_model->ajax_insignias();
        echo json_encode($json);

    }

}
