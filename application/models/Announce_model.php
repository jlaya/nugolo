<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announce_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /**
    / Encuesta info
    */

    public function show()
    {   
        if( $this->session->userdata('role_id') != 1 ){
            $this->db->where('user_id', $this->session->userdata('user_id') );
        }
        $query = $this->db->get('announce');
        return $query->result();
    }

    public function announceActive()
    {   
        $this->db->where('status', 1 );
        $query = $this->db->get('announce');
        return $query->result();
    }

    public function show_public()
    {
        $query = $this->db->get('announce');
        return $query->result();
    }

    public function save($data) {

        if( $data['id'] == 0 ){
            $this->db->insert('announce', $data);
        }else{
            $this->db->where('id', $data['id']);
            $this->db->update('announce', $data);
        }
    }

    public function detail( $id )
    {   
        $this->db->where('id', $id);
        $query = $this->db->get('announce');
        return $query->row();
    }

    public function delete( $id )
    {
        $this->db->where('id', $id);
        $this->db->delete('announce');
    }
}
