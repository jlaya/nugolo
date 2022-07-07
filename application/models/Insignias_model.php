<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insignias_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /**
    / Encuesta info
    */

    public function show()
    {
        $query = $this->db->get('insignias');
        return $query->result();
    }

    public function show_public()
    {
        $query = $this->db->get('insignias');
        return $query->result();
    }

    public function add($data) {

        if( $data['id'] == 0 ){
            $this->db->insert('insignias', $data);
        }else{
            $this->db->where('id', $data['id']);
            $this->db->update('insignias', $data);
        }
    }

    public function detail( $id )
    {   
        $this->db->where('id', $id);
        $query = $this->db->get('insignias');
        return $query->row();
    }

    public function delete( $id )
    {
        $this->db->where('id', $id);
        $this->db->delete('insignias');
    }

    public function verify_insignias()
    {   
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('question_insignias');
        return $query->num_rows();
    }

    public function add_question($data){
        $this->db->insert('question_insignias', $data);
    }

    public function ajax_insignias()
    {   
        $this->db->select('a.id,a.nombre AS name');
        $this->db->where( 'a.valorCoin <>' , 0 );
        $query = $this->db->get('reglas_logros AS a');
        return $query->result();
    }

    public function get_course_ids( $insignias_id )
    {   
        $this->db->select('a.course_ids');
        $this->db->where( 'a.id' , $insignias_id );
        $query = $this->db->get('insignias AS a');
        return $query->row();
    }

    public function add_course_ids($data){
        return $this->db->insert('enroll', $data);
    }

    // Mostrar en el frontend las Insignias que lleva el estudiante
    public function showInsignias()
    {
        $this->db->select('*');
        $this->db->from('history_logros AS a');
        $this->db->join('reglas_logros AS b', 'b.id = a.type');
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $this->db->group_by('b.nombre');
        #$this->db->order_by('a.id','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Mostrar las insignias asociadas
    public function insignias_all( $ids )
    {
        $this->db->select('a.id,a.avatar');
        $this->db->from('insignias AS a');
        $this->db->where_in('course_ids', $ids, false);
        $query = $this->db->get();
        return $query->result();
    }

    // Mostrar las insignias asociadas
    public function wallet_insignias( $ids )
    {
        $this->db->select('SUM(a.valorCoin) AS cant');
        $this->db->from('insignias AS a');
        $this->db->where_in('course_ids', $ids, false);
        $query = $this->db->get();
        return $query->row();
    }

}
