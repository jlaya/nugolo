<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matriculation_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /**
    / Encuesta info
    */

    public function show()
    {
        $query = $this->db->get('matriculation');
        return $query->result();
    }

    public function show_public()
    {
        $query = $this->db->get('matriculation');
        return $query->result();
    }

    public function save($data) {

        if( $data['id'] == 0 ){
            $this->db->insert('matriculation', $data);
        }else{
            $this->db->where('id', $data['id']);
            $this->db->update('matriculation', $data);
        }
    }

    public function detail( $id )
    {   
        $this->db->where('id', $id);
        $query = $this->db->get('matriculation');
        return $query->row();
    }

    public function delete( $id )
    {
        $this->db->where('matriculation_id', $id);
        $query  = $this->db->get('question_matriculation');
        $result = $query->num_rows();

        if( $result == 0 ){
            $this->db->where('id', $id);
            $this->db->delete('matriculation');
        }
    }

    public function verify_matriculation()
    {   
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('question_matriculation');
        return $query->num_rows();
    }

    public function add_question($data){
        $this->db->insert('question_matriculation', $data);
    }

    public function ajax_courses()
    {   
        $this->db->select('a.id,a.title');
        //$this->db->where('a.status', 'active');
        $query = $this->db->get('course AS a');
        return $query->result();
    }

    public function get_course_ids( $matriculation_id )
    {   
        $this->db->select('a.course_ids');
        $this->db->where( 'a.id' , $matriculation_id );
        $query = $this->db->get('matriculation AS a');
        return $query->row();
    }

    public function add_course_ids($data){
        return $this->db->insert('enroll', $data);
    }

}
