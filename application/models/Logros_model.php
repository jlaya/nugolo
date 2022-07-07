<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logros_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /**
    / Encuesta info
    */

    public function show()
    {
        $query = $this->db->get('logros');
        return $query->result();
    }

    public function show_public()
    {
        $query = $this->db->get('logros');
        return $query->result();
    }

    public function save($data) {

        if( $data['id'] == 0 ){
            $this->db->insert('logros', $data);
        }else{
            $this->db->where('id', $data['id']);
            $this->db->update('logros', $data);
        }
    }

    public function detail( $id )
    {   
        $this->db->where('id', $id);
        $query = $this->db->get('logros');
        return $query->row();
    }

    public function delete( $id )
    {
        $this->db->where_in('course_ids', (int)$id);
        $query  = $this->db->get('insignias');
        $result = $query->num_rows();

        if( $result == 0 ){
            $this->db->where('id', $id);
            $this->db->delete('logros');
        }
    }

}
