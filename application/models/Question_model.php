<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /**
    / Encuesta info
    */

    public function save($data) {

        if( $data['id'] == 0 ){
            $this->db->insert('question_info', $data);
        }else{
            $this->db->where('id', $data['id']);
            $this->db->update('question_info', $data);
        }
    }

    public function show()
    {   
        $query = $this->db->get('question_info');
        return $query->result();
    }

    public function pull_response()
    {   
        $this->db->select('b.id, b.first_name, b.last_name');
        $this->db->from('users_detail AS a');
        $this->db->join('users AS b', 'a.user_id = b.id');
        $this->db->where('a.pay', 1 );
        $query = $this->db->get();
        return $query->result();
    }

    public function ajax_pull( $user_id )
    {   
        $this->db->select('a.id, b.question ,a.response');
        $this->db->from('pull AS a');
        $this->db->join('question AS b', 'a.question_id = b.id');
        $this->db->where('a.user_id', $user_id );
        $this->db->order_by('a.id', 'ASC' );
        $query = $this->db->get();
        return $query->result();
    }

    public function detail( $id )
    {   
        $this->db->where('id', $id);
        $query = $this->db->get('question_info');
        return $query->row();
    }

    

    public function delete( $id )
    {
        $this->db->where('question_info_id =', $id);
        $result = $this->db->get('question');

        if ($result->num_rows() > 0) {
            return 'exists';
        } else {

            $this->db->where('id', $id);
            $this->db->delete('question_info');
        }
    }
    /**
    / *****************************************************************************
    */
    public function save_question($data) {

        if( $data['id'] == 0 ){
            $this->db->insert('question', $data);
        }else{
            unset($data['question_info_id']);
            $this->db->where('id', $data['id']);
            $this->db->update('question', $data);
        }
    }

    public function question_info()
    {
        $query = $this->db->get('question_info');
        return $query->result();
    }

    public function question($question_info_id)
    {   
        $this->db->where('question_info_id', $question_info_id);
        $query = $this->db->get('question');
        return $query->result();
    }

    public function question_user_detail($question_info_id)
    {   
        $this->db->select("a.*, b.id AS pull_id, b.question_id, b.response AS res_question");
        $this->db->from('question AS a');
        $this->db->join('pull AS b', 'a.id = b.question_id', 'inner');
        $this->db->where('question_info_id', $question_info_id);
        $this->db->where('b.user_id', $this->session->userdata('user_id') );
        $query = $this->db->get();
        return $query->result();
    }

    public function detail_question( $id )
    {   
        $this->db->where('id', $id);
        $query = $this->db->get('question');
        return $query->row();
    }

    public function delete_question( $id )
    {
        $this->db->where('question_id =', $id);
        $result = $this->db->get('pull');

        if ($result->num_rows() > 0) {
            return 'exists';
        } else {

            $this->db->where('id', $id);
            $this->db->delete('question');
        }
    }

    public function add_pull($data) {
        $data['user_id'] = $this->session->userdata('user_id');
        $data['datetime'] = date('Y-m-d H:i:s');
        $this->db->insert('pull', $data);
    }

    public function update_pull( $id, $data ) {
        $this->db->where('user_id', $this->session->userdata('user_id') );
        $this->db->where('question_id', $id );
        $this->db->update('pull', $data);
    }

    public function exists_pull( $form, $user_id )
    {   
        $this->db->where('form', $form);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('pull');
        return count($query->row());
    }

    public function exists_users_detail( $user_id )
    {
        $this->db->select('a.pay');
        $this->db->where('a.user_id', $user_id);
        $query = $this->db->get('users_detail AS a');
        return $query->row();
    }
}
