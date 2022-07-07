<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announce extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Announce_model');
    }

    public function index( $data = [] ) {
        $data['page_title'] = 'Cartera de anuncios';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['obj'] = $this->Announce_model->show();
        $this->load->view('backend/announce/index', $data );
    }

    public function new() {

        $data['role_id'] = $this->session->userdata('role_id');
        $data['page_title'] = 'Crear nuevo anuncio';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $this->load->view('backend/announce/add' , $data );
    }

    public function add() {

        $data['title']    = $this->input->post('title');
        $data['url']      = $this->input->post('url');
        $data['user_id']  = $this->session->userdata('user_id');
        $data['datetime'] = date('Y-m-d H:i:s');
        if ($_FILES['image']['name'] != ""):
            $archivo = $_FILES['image']['name'];
            $ex      = explode('.', $archivo);
            $ex      = $ex[1]; // Extencion
            $archivo = 'doc-'.$this->input->post('id') . "." . $ex;
            $ruta    = getcwd();  // Obtiene el directorio actual en donde se esta trabajando
            //echo $ruta;
            move_uploaded_file($_FILES['image']['tmp_name'], $ruta . "/assets/backend/doc/" . $archivo);
            $data['image'] = $archivo;
        endif;
        $this->Announce_model->save($data);
        redirect(site_url('announce'), 'refresh');
    }

    public function edit( $id ) {

        $data['role_id'] = $this->session->userdata('role_id');
        $data['page_title'] = 'Editar Cartera de anuncios';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['edit'] = $this->Announce_model->detail( $id );
        $this->load->view('backend/announce/update', $data );
    }

    public function update() {

        if ($_FILES['image']['name'] != ""):
            $archivo = $_FILES['image']['name'];
            $ex      = explode('.', $archivo);
            $ex      = $ex[1]; // Extencion
            $archivo = 'doc-'.$this->input->post('id') . "." . $ex;
            $ruta    = getcwd();  // Obtiene el directorio actual en donde se esta trabajando
            //echo $ruta;
            move_uploaded_file($_FILES['image']['tmp_name'], $ruta . "/assets/backend/doc/" . $archivo);
            $data['image'] = $archivo;
        endif;

        $data['id']       = $this->input->post('id');
        $data['title']    = $this->input->post('title');
        $data['url']      = $this->input->post('url');
        $data['datetime'] = date('Y-m-d H:i:s');
        $this->Announce_model->save($data);
        redirect(site_url('announce'), 'refresh');
    }

    public function delete( $id ) {

        $result = $this->Announce_model->delete( $id );
        if( $result ){
            $data['message'] = "Se ha eliminado el anuncio";
        }
        redirect(site_url('announce'), 'refresh');
    }

}
