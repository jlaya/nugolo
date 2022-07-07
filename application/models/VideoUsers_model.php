<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VideoUsers_model extends CI_Model {

  // constructor
	function __construct()
	{
		parent::__construct();
	}

	public function all_multi_media_users() {

		$user_id = $this->session->userdata('user_id');
		$this->db->where('user_id', $user_id );
        $query = $this->db->get('multi_media_users');
        return count($query->result());

	}

	public function viewed() {

		$this->db->where('viewed', 1 );
        $query = $this->db->get('multi_media_users');
        return count($query->result());

	}

	public function register($data) {

        $this->db->where('user_id =', $data['user_id']);
        $this->db->where('videoId =', $data['videoId']);
        $result = $this->db->get('multi_media_users');

        if ($result->num_rows() > 0) {
            echo 'exists';
            $this->db->where('user_id =', $data['user_id']);
        	$this->db->where('videoId =', $data['videoId']);
            $this->db->update('multi_media_users', 
	            	array(
	            		"current" => $data['current'],
	            		"duration" => $data['duration'],
	            		"viewed" => $data['viewed']
	            	)
        		);
        } else {
        	$this->db->insert('multi_media_users', $data);
        }
    }

    public function show_items( $token )
    {
        $this->db->select("a.id,a.url,a.title,b.viewed,b.current,b.duration");
        $this->db->from('multi_media AS a');
        $this->db->join('multi_media_users AS b', 'a.id = b.multi_media_id', 'left');
        $this->db->order_by("a.id", "ASC");
        $this->db->where('a.token', $token );
        $query = $this->db->get();
        return $query->result();
    }

}
