<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matriculation extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Matriculation_model');
    }

    public function index( $data = [] ) {
        $data['page_title'] = 'Matriculación de rutinas';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['obj'] = $this->Matriculation_model->show();
        $this->load->view('backend/matriculation/index', $data );
    }

    public function new() {

        $data['role_id'] = $this->session->userdata('role_id');
        $data['page_title'] = 'Crear nueva matriculación';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $this->load->view('backend/matriculation/add' , $data );
    }

    public function add() {

        $course_ids           = $this->input->post('course_ids');
        $data['course_ids']   = implode(',', $course_ids);
        $data['name']         = $this->input->post('name');
        $data['date_created'] = date('Y-m-d');
        if ($_FILES['avatar']['name'] != ""):
            $archivo = $_FILES['avatar']['name'];
            $ex      = explode('.', $archivo);
            $ex      = $ex[1]; // Extencion
            $archivo = 'icon-'.$this->input->post('name') . "." . $ex;
            $ruta    = getcwd();  // Obtiene el directorio actual
            move_uploaded_file($_FILES['avatar']['tmp_name'], $ruta . "/assets/backend/matriculation/" . $archivo);
            $data['avatar'] = $archivo;
        endif;
        $object = $this->Matriculation_model->save($data);
        redirect(site_url('matriculation'), 'refresh');
    }

    public function edit( $id ) {

        $data['role_id'] = $this->session->userdata('role_id');
        $data['page_title'] = 'Editar Cartera de anuncios';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['edit'] = $this->Matriculation_model->detail( $id );
        $this->load->view('backend/matriculation/update', $data );
    }

    public function update() {

        if ($_FILES['avatar']['name'] != ""):
            $archivo = $_FILES['avatar']['name'];
            $ex      = explode('.', $archivo);
            $ex      = $ex[1]; // Extencion
            $archivo = 'icon-'.$this->input->post('name') . "." . $ex;
            $ruta    = getcwd();  // Obtiene el directorio actual
            move_uploaded_file($_FILES['avatar']['tmp_name'], $ruta . "/assets/backend/matriculation/" . $archivo);
            $data['avatar'] = $archivo;
        endif;

        $data['id']           = $this->input->post('id');
        $data['name']         = $this->input->post('name');
        $course_ids           = $this->input->post('course_ids');
        $data['course_ids']   = implode(',', $course_ids);
        $data['date_created'] = date('Y-m-d');
        $this->Matriculation_model->save($data);
        redirect(site_url('matriculation'), 'refresh');
    }

    public function delete( $id ) {

        $result = $this->Matriculation_model->delete( $id );
        if( $result ){
            $data['message'] = "Se ha eliminado el anuncio";
        }
        redirect(site_url('matriculation'), 'refresh');
    }

    public function add_question() {

        $matriculation_id = $this->input->post('matriculation_id');

        foreach ($matriculation_id as $key => $ids) {
            # code...
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'matriculation_id' => $ids,
                'date_created' => date("Y-m-d")
            );

            $this->Matriculation_model->add_question( $data );

            $course_ids = $this->Matriculation_model->get_course_ids( $ids );
            foreach (explode(',', $course_ids->course_ids) as $key => $course_id) {
                # code...
                $data_enroll = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'course_id' => $course_id,
                    'date_added' => strtotime(date("Y-m-d H:i:s"))
                );
                $this->Matriculation_model->add_course_ids( $data_enroll );
            }

            

        }

        redirect(site_url('home'), 'refresh');
    }

    public function ajax_courses(){

        $json = $this->Matriculation_model->ajax_courses();
        echo json_encode($json);

    }

}
