<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    /**
    / Ingreso de Grupos
    */
    public function register($data) {

        $this->db->insert('channel_group', $data);
        $channel_group_id = $this->db->insert_id();

        $this->db->where('channel_group_id =', $channel_group_id );
        $this->db->where('user_id =', $this->session->userdata('user_id') );
        $this->db->where('is_admin =', 1 );
        $result = $this->db->get('channel_group_users');

        if ($result->num_rows() > 0) {
            echo 'exists';
        } else {
            $data_new['channel_group_id'] = $channel_group_id;
            $data_new['user_id']          = $this->session->userdata('user_id');
            $data_new['is_admin']         = 1;
            $data_new['datetime']         = date('Y-m-d H:i:s');
            $result = $this->db->insert('channel_group_users', $data_new);
        }

    }

    public function channel_group( $user_id )
    {
        $this->db->select('a.id, a.name');
        $this->db->from('channel_group AS a');
        $this->db->join('channel_group_users AS b', "b.user_id = $user_id",'left');
        $this->db->where('a.open =', 0 );
        $this->db->group_by("a.name");
        $query = $this->db->get();
        return $query->result();
    }

    public function users( $channel_group_id )
    {   
        $sql = "SELECT a.id,b.id AS channel_id, a.first_name, a.last_name,b.user_id,b.channel_group_id FROM users AS a LEFT JOIN channel_group_users AS b ON( a.id = b.user_id AND b.channel_group_id = $channel_group_id ) ORDER BY a.id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function joins_channel_group_users( $channel_group_users_id, $user_id, $channel_group_id ) {

        if( $user_id == null ){
            $data_new['user_id']          = $channel_group_users_id;
            $data_new['channel_group_id'] = $channel_group_id;
            $this->db->insert('channel_group_users', $data_new);
        }else{
            $this->db->where('user_id', $channel_group_users_id );
            $this->db->where('channel_group_id', $channel_group_id );
            $this->db->delete('channel_group_users');
        }

    }

    /**
    / Ingreso de Grupos Fin
    */

    public function send($data) {
        $this->db->insert('chat', $data);
        return $this->db->insert_id();
    }

    public function join_users($data) {
        $this->db->insert('join_channel', $data);
        return $this->db->insert_id();
    }

    // Se muestra los mensajes
    public function show_messages( $channel_group_id )
    {
        $this->db->select('a.id, CONCAT(b.first_name," ",b.last_name) AS name, a.message, a.datetime');
        $this->db->from('chat AS a');
        $this->db->join('users AS b', 'a.user_id = b.id');
        //$this->db->join('channel_group_users AS c', 'a.channel_group_id = c.channel_group_id');
        $this->db->where('a.channel_group_id', $channel_group_id);
        $query = $this->db->get();
        return $query->result();
    }

    // Se muestra la caja de texto si se encuentra con el permiso consedido
    public function permission_channel( $channel_group_id, $user_id )
    {   
        $is_admin = array(0, 1);
        $this->db->where('channel_group_id', $channel_group_id);
        $this->db->where('user_id', $user_id);
        $this->db->where_in('is_admin', $is_admin );
        $query = $this->db->get('channel_group_users');
        return count($query->result());
    }

    public function show_channel( $user_id )
    {   
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('join_channel');
        return count($query->result());
    }

    public function delete( $id )
    {
        $this->db->where('id', $id);
        $this->db->delete('multi_media');
    }
}
