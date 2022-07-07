<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Document_model','doc');
    }

    public function index() {
        $course_id = $this->input->get('course_id');
        $data['page_title'] = 'Documentos';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['obj']    = $this->doc->getDoc($course_id);
        $data['verify'] = $this->doc->verifyDoc($course_id);
        $this->load->view('frontend/document/list', $data );
    }

    public function calificaciones() {
        if ($this->session->userdata('admin_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $this->session->set_userdata('last_page', 'dashboard');
        $page_data['page_name']  = 'calificaciones';
        $page_data['page_title'] = get_phrase('Calificaciones');
        $page_data['obj']        = $this->doc->getDocTeacher();
        #echo $this->db->last_query(); exit;
        $this->load->view('backend/index.php', $page_data);
    }

    public function save() {


        $username  = $this->session->userdata('name');
        $user_id   = $this->session->userdata('user_id');
        $course_id = $this->input->post('course_id');

        if ($_FILES['doc']['name'] != ""):
            $archivo = $_FILES['doc']['name'];
            $ex      = explode('.', $archivo);
            $ex      = $ex[1]; // Extencion
            $archivo = "Estudiante ($username)- Curso($course_id)" . "." . $ex;
            $ruta    = getcwd();  // Obtiene el directorio actual en donde se esta trabajando
            //echo $ruta;
            move_uploaded_file($_FILES['doc']['tmp_name'], $ruta . "/assets/doc/" . $archivo);
            $data['doc']         = "assets/doc/".$archivo;
            endif;

        $data['user_id']   = $user_id;
        $data['course_id'] = $course_id;
        $this->doc->add($data);
        redirect(site_url('document?course_id='.$course_id), 'refresh');
    }

    public function is_approved_yes(){

        $data = $this->input->post();
        $this->doc->is_approved_yes($data);
    }

}
