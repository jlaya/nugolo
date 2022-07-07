<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confirmation_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /**
    / Consultas
    */


    public function show()
    {   
        $this->db->select('a.id AS model_id ,b.id AS user_id, b.first_name , b.last_name, a.state, a.confirmation, a.doc_number, a.response');
        $this->db->from('users_detail AS a');
        $this->db->join('users AS b', 'a.user_id = b.id');
        $this->db->order_by("a.id", "DESC");
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function send( $model_id, $user_id ) {

        // Usuario
        $this->db->where( 'id', $model_id );
        $this->db->update(
            'users_detail', 
                array(
                    "confirmation" => 1
                )
        );

        // Confirmacion
        $this->db->where( 'id', $user_id );
        $this->db->update('users', array( "status" => 1  ) );
        
    }

    // forma de validar las tareas de cada usuario Estudiante
    public function is_checked( $id, $is_checked ) {

        $this->db->where( 'id', $id );
        $this->db->update(
            'people', 
                array(
                    "is_checked" => $is_checked
                )
        );
        
    }
}
