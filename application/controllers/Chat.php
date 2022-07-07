<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        // Load models
        $this->load->model('Chat_model');
        $this->load->library('session');
    }

    // Chat principal
    public function index() {
        $data['user_id']           = $this->session->userdata('user_id');
        $data['channel_group']     = $this->Chat_model->channel_group( $this->session->userdata('user_id') );
        //echo $this->db->last_query(); exit;
        $data['join_channel'] = $this->Chat_model->show_channel( $data['user_id'] );
        $this->load->view('chat/index.php', $data);
    }

    // Chat interno cursos
    public function chat_private() {
        $data['user_id']           = $this->session->userdata('user_id');
        $data['channel_group']     = $this->Chat_model->channel_group( $this->session->userdata('user_id') );
        //echo $this->db->last_query(); exit;
        $data['join_channel'] = $this->Chat_model->show_channel( $data['user_id'] );
        $this->load->view('chat/index-private.php', $data);
    }

    /**
    / Ingreso de Grupos
    */
    public function register() {

        $data['user_id'] = $this->session->userdata('user_id');
        $data['name'] = $this->input->post('name');
        $data['datetime'] = date('Y-m-d H:i:s');
        $result = $this->Chat_model->register($data);
        redirect("chat?group=1");
    }

    // Cierre de grupos
    public function close_group( $id ) {
        $this->db->where('a.id', $id );
        $this->db->update('channel_group AS a', array("a.open" => 1 ) );
        redirect("chat?group=1");
    }

    public function show_channel() {

        $result = $this->Chat_model->show_channel( $this->session->userdata('user_id') );
        echo json_encode(array('message'=> $result ));

    }

    public function join_channel_group_users() {

        $data['channel_group_id'] = $this->input->post('channel_group_id');
        $data['user_id'] = $this->input->post('user_id');
        $data['datetime'] = date('Y-m-d H:i:s');
        $result = $this->Chat_model->join_channel_group_users($data);
        redirect("chat?group=1");
    }

    public function users() {
        $channel_group_id = $this->input->post('channel_group_id');
        $json = $this->Chat_model->users( $channel_group_id );
        echo json_encode($json);
    }

    // Ingreso de miembros al grupo
    public function joins_channel_group_users() {
        
        $channel_group_users_id = $this->input->post('channel_group_users_id');
        $user_id                = $this->input->post('user_id');
        $channel_group_id       = $this->input->post('channel_group_id');
        $this->Chat_model->joins_channel_group_users( $channel_group_users_id, $user_id, $channel_group_id );
        //echo $this->db->last_query();
    }

    /**
    / Ingreso de Grupos Fin
    */

    public function show_messages() {
        $channel_group_id = $this->input->post('channel_group_id');
        $result['messages'] = $this->Chat_model->show_messages( $channel_group_id );
        $result['permission_channel'] = $this->Chat_model->permission_channel( $channel_group_id, $this->session->userdata('user_id') );
        echo json_encode( $result );
    }

    // Logro por (escribir en su primer grupo)
    public function primer_grupo( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('history_logros AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.type', 7);
        $query = $this->db->get();
        return $query->row();
    }

    // Envio de mensaje
    public function send() {

        $data['user_id']          = $this->session->userdata('user_id');
        $data['message']          = $this->input->post('message');
        $data['channel_group_id'] = $this->input->post('channel_group_id');
        $data['datetime']         = date('Y-m-d H:i:s');

        $primer_grupo = $this->primer_grupo( $data['user_id'], 0 )->can;

        if( $primer_grupo == 0 ){
            $history_logros['user_id']   = $data['user_id'];
            $history_logros['course_id'] = 0;
            $history_logros['lesson_id'] = 0;
            $history_logros['type']      = 7;
            $this->db->insert('history_logros', $history_logros);
        }

        $result = $this->Chat_model->send($data);
    }

    public function join_channel() {

        $data['user_id'] = $this->session->userdata('user_id');
        $data['datetime'] = date('Y-m-d H:i:s');
        $result = $this->Chat_model->join_users($data);

        if ($result) {
            echo json_encode(array('message'=>'ok'));
        }

    }
    

}
