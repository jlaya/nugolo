<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homework extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Homework_model');
    }

    public function notifications_users() {
        // Tomamos la fecha actual
        $user_id      = $this->session->userdata('user_id');
        $current_date = date('Y-m-d');

        $homework = $this->Homework_model->notifications( $user_id );

        foreach ($homework as $key => $value) {
            $range_from     = $value->range_from;
            $range_to       = $value->range_to;
            $check_in_range = $this->check_in_range($current_date, $range_from, $range_to);

            $data[] = array(
                'name' => $value->name,
                'is_date' => $check_in_range
            );

        }
        
        echo json_encode($data);

    }

    public function index( $data = [] ) {
        $data['page_title'] = 'Tareas';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['obj'] = $this->Homework_model->getHomework();
        $this->load->view('backend/homework/homework', $data );
    }

    public function register() {

        $role_id = $this->session->userdata('role_id');

        if( $role_id == 3 ){
            $color = "#1e90ff";
        }else if( $role_id == 4 ){
            $color = "#98bf11";
        }else if( $role_id == 5 ){
            $color = "#c96dd4";
        }else if( $role_id == 6 ){
            $color = "#00befc";
        }

        $data['color'] = $color;
        $data['page_title'] = 'Crear nueva Tarea';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['course'] = $this->Homework_model->getCourse();
        $this->load->view('backend/homework/homework_add', $data );
    }

    public function edit( $id ) {

        $data['page_title'] = 'Editar Tarea';
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $data['course'] = $this->Homework_model->getCourse();
        $data['edit'] = $this->Homework_model->findHomework( $id );
        $this->load->view('backend/homework/homework_update', $data );
    }

    public function add() {

        $data['id']         = $this->input->post('id');
        $data['name']       = $this->input->post('name');
        $data['url']        = $this->input->post('url');
        $data['course_id']  = $this->input->post('course_id');
        $data['range_from'] = $this->input->post('range_from');
        $data['range_to']   = $this->input->post('range_to');
        $data['user_id']    = $this->session->userdata('user_id');
        $data['color']      = $this->input->post('color');
        $data['datetime']   = date('Y-m-d H:i:s');
        $this->Homework_model->send($data);
        redirect(site_url('admin/homework'), 'refresh');
    }

    public function update() {

        $data['id']         = $this->input->post('id');
        $data['name']       = $this->input->post('name');
        $data['url']        = $this->input->post('url');
        $data['course_id']  = $this->input->post('course_id');
        $data['range_from'] = $this->input->post('range_from');
        $data['range_to']   = $this->input->post('range_to');
        $data['color']      = $this->input->post('color');
        $this->Homework_model->send($data);
        redirect(site_url('admin/homework'), 'refresh');
    }

    public function delete( $id ) {

        $result = $this->Homework_model->delete( $id );

        if( $result == 'existe' ){
            $data['message'] = "Disculpe, no puede eliminar la tarea, se encuentra asignada a uno o mas participantes";
        }else{
            $data['message'] = "Se ha eliminado la tarea";
        }
        
        $this->index( $data );
    }

    // Método público para verificar si una fecha está dentro de un rango de fechas
    public function check_in_range($date, $range_from, $range_to) {
        
        $range_from = strtotime($range_from);
        $range_to = strtotime($range_to);
        $date = strtotime($date);

        if(($date >= $range_from) && ($date <= $range_to)) {

            return 'true';

        } else {

            return 'false';

        }
            
    }

    /**
    / Relacion de usuarios con tareas
    */

    public function joins( $id ) {
        
        $data['id'] = $id;
        $data['page_title'] = 'Relación de participantes';
        $data['users'] = $this->Homework_model->getUsers();
        $data['people'] = $this->Homework_model->getPeople( $id );
        $data['logged_in_user_role'] = strtolower($this->session->userdata('role'));
        $this->load->view('backend/homework/joins', $data );
    }

    public function join_people() {

        $data['join_id']  = $this->input->post('join_id');
        $data['user_id']  = $this->input->post('user_id');
        $data['datetime'] = date('Y-m-d H:i:s');
        $this->Homework_model->join_people($data);
        redirect(site_url('admin/homework/joins/'.$data['join_id']), 'refresh');
    }

    public function delete_people( $id, $join_id ) {

        $name = $this->input->get('name');
        $this->Homework_model->delete_people( $id );
        
        redirect(site_url('admin/homework/joins/'.$join_id."?name=".$name ), 'refresh');
    }

}
