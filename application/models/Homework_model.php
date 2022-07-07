<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homework_model extends CI_Model {

  // constructor
	function __construct()
	{
		parent::__construct();
	}

	public function notifications( $user_id ) {
        $this->db->select(' b.range_from, b.range_to, b.name, b.url ');
        $this->db->join('homework AS b', "b.id = a.join_id");
        $this->db->where('a.user_id', $user_id);
        return $this->db->get('people AS a')->result();
	}

    public function getCourse() {
        
        $query = $this->db->get('course');
        return $query->result_array();

    }

    public function getHomework() {

        $this->db->where('user_id =', $this->session->userdata('user_id') );
        $query = $this->db->get('homework');
        return $query->result_array();

    }

    public function findHomework( $id ) {

        $this->db->where('id =', $id );
        $query = $this->db->get('homework');
        return $query->row_array();

    }

	public function send($data) {

        if ( $data['id'] > 0 ) {
            $this->db->where('id =', $data['id']);
            $this->db->update('homework', 
	            	array(
	            		"name"       => $data['name'],
                        "url"        => $data['url'],
                        "course_id"  => $data['course_id'],
                        "range_from" => $data['range_from'],
                        "range_to"   => $data['range_to'],
                        "color"      => $data['color']
	            	)
        		);
        } else {

            $this->db->where('name =', $data['name']);
            $result = $this->db->get('homework');
            if ($result->num_rows() > 0) {
                echo 'exists';
            }else{
                unset($data['id']);
        	   $this->db->insert('homework', $data);
            }

        }
    }

    public function delete( $id )
    {
        $this->db->where('join_id =', $id);
        $result = $this->db->get('people');

        if ($result->num_rows() > 0) {
            return 'existe';
        } else {

            $this->db->where('id', $id);
            $this->db->delete('homework');
        }
    }

    public function getUsers() {
        $this->db->where('role_id =', 2 );
        return $this->db->get('users')->result();
    }

    /**
    / Relacion de usuarios con tareas
    */

    public function join_people( $data ) {

        $this->db->where('join_id =', $data['join_id']);
        $this->db->where('user_id =', $data['user_id']);
        $result = $this->db->get('people');

        if ($result->num_rows() > 0) {
            echo 'existe';
        } else {
            $this->db->insert('people', $data);
        }
    }

    public function getPeople( $join_id ) {
        $this->db->select(' a.*,b.first_name, b.last_name ');
        $this->db->from('people AS a');
        $this->db->join('users AS b', 'a.user_id = b.id');
        $this->db->where('join_id =', $join_id );
        $this->db->where('b.role_id =', 2 );
        return $this->db->get()->result();
    }

    public function delete_people( $id )
    {
        $this->db->where('id', $id);
        return $this->db->delete('people');
    }

}
