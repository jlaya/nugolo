<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logros extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Logros_model');
    }

    public function index( $data = [] ) {
        $data['page_title'] = 'Logros';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['obj'] = $this->Logros_model->show();
        $this->load->view('backend/logros/index', $data );
    }

    public function new() {

        $data['role_id'] = $this->session->userdata('role_id');
        $data['page_title'] = 'Crear nuevo logro';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $this->load->view('backend/logros/add' , $data );
    }

    public function add() {

        $data['name'] = $this->input->post('name');
        $object = $this->Logros_model->save($data);
        redirect(site_url('logros'), 'refresh');
    }

    public function edit( $id ) {

        $data['page_title'] = 'Editar Logros';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['edit'] = $this->Logros_model->detail( $id );
        $this->load->view('backend/logros/update', $data );
    }

    public function update() {

        $data['id']           = $this->input->post('id');
        $data['name']         = $this->input->post('name');
        $this->Logros_model->save($data);
        redirect(site_url('logros'), 'refresh');
    }

    public function delete( $id ) {

        $result = $this->Logros_model->delete( $id );
        if( $result ){
            $data['message'] = "Se ha eliminado el logro";
        }
        redirect(site_url('logros'), 'refresh');
    }

}
