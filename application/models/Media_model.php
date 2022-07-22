<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function get_children( $children_id ) {
        $this->db->where('id', $children_id);
        return $this->db->get('course')->row_array();
    }


    public function multi_media( $data ) {
        $this->db->insert('multi_media', $data);
        return $this->db->insert_id();
    }

    public function get_group_media( $token )
    {
        $this->db->select('multi_media.week,multi_media.month');
        #$this->db->select('multi_media.month');
        $this->db->where('token', $token);
        $this->db->group_by('month');
        $query = $this->db->get('multi_media');
        return $query->result();
    }

    public function first_get_media( $token )
    {
        $this->db->where('status', 0 );
        $this->db->where('token', $token);
        #$this->db->order_by( 'id' ,'ASC' );
        $this->db->limit(1);
        $query = $this->db->get('multi_media');
        return $query->row();
    }

    public function get_media( $token )
    {
        $this->db->where('token', $token);
        $query = $this->db->get('multi_media');
        return $query->result();
    }

    public function delete( $id )
    {
        $this->db->where('id', $id);
        $this->db->delete('multi_media');
    }

    public function check_duplication( $title ) {
        $duplicate = $this->db->get_where('multi_media', array('title' => $title));

        if ($duplicate->num_rows() > 0) {
            return false;
        }else {
            return true;
        }
    }

    // Ingreso de video automaticamente segun el usuario
    public function add_video( $course_id, $token ) {

        $obj = $this->get_media( $token );

        foreach ($obj as $key => $value) {
            # code...
            $this->db->where('user_id =', $this->session->userdata('user_id'));
            $this->db->where('course_id =', $course_id );
            $this->db->where('multi_media_id =', $value->id );
            $this->db->where('token = ', $token);
            $result = $this->db->get('multi_media_users');

            if ($result->num_rows() > 0) {
                echo '';
            }else{
                $data_video['user_id']        = $this->session->userdata('user_id');
                $data_video['course_id']      = $course_id;
                $data_video['multi_media_id'] = $value->id;
                $data_video['token']          = $token;
                $data['datetime']             = date('Y-m-d H:i:s');
                $this->db->insert('multi_media_users', $data_video);
            }
        }
    }

    public function group_by_users( $token )
    {
        $this->db->select('b.id,b.month,b.token');
        $this->db->from('multi_media_users AS a');
        $this->db->join('multi_media AS b', 'b.id = a.multi_media_id');
        //$this->db->where('a.is_checked', 0);
        $this->db->where('b.token', $token);
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        #$this->db->order_by('b.id','ASC');
        $this->db->group_by('month');
        $query = $this->db->get();
        return $query->result();
    }

    public function searchDocument( $course_id )
    {
        $this->db->select('count(a.id) AS cant');
        $this->db->from('doc AS a');
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->row();
    }

    public function group_by_courses( $token )
    {
        $this->db->select('b.id,b.month,b.token');
        $this->db->from('multi_media_users AS a');
        $this->db->join('multi_media AS b', 'b.id = a.multi_media_id');
        $this->db->where('b.token', $token);
        $this->db->group_by('month');
        $query = $this->db->get();
        return $query->result();
    }

    public function sum_modules( $token )
    {
        $this->db->select('SUM(a.num_lec) AS sum_modules');
        $this->db->from('multi_media AS a');
        #$this->db->where('a.type', 3);
        $this->db->where('a.token', $token);
        $query = $this->db->get();
        return $query->row();
    }

    public function find_sum_modules( $module )
    {
        $this->db->select('SUM(a.sum_modules) AS find_sum_modules');
        $this->db->from('history_user AS a');
        $this->db->join('multi_media AS b', 'b.id = a.multi_media_id');
        $this->db->where('b.month', $module);
        $this->db->group_by('b.month');
        $query = $this->db->get();
        return $query->row();
    }

    // Se toman la cantidad de cursos que ha obtenido el curso
    public function history_users()
    {
        $this->db->select('SUM(a.sum_modules) AS cant_module');
        $this->db->from('history_user AS a');
        $this->db->where('a.is_checked', 0);
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->row();
    }

    // Se toman la cantidad de cursos que ha obtenido el curso para asi verificar
    // si cumplio o no con las lecciones por cada modulo y efectuar la puntuacion
    public function verify_history_users()
    {
        $this->db->select('SUM(a.sum_modules) AS cant_module');
        $this->db->from('history_user AS a');
        $this->db->where('a.is_checked', 0);
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->row();
    }

    public function get_modules( $module, $token )
    {
        $this->db->select('a.id,SUM(a.num_lec) AS sum_modules');
        $this->db->from('multi_media AS a');
        #$this->db->where('a.type', 3);
        $this->db->where('a.month', $module);
        $this->db->where('a.token', $token);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_sum_modules( $id )
    {
        $this->db->select('SUM(a.num_lec) AS sum_modules');
        $this->db->from('multi_media AS a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_ids_module_users( $token )
    {
        $this->db->select('*');
        $this->db->from('multi_media AS a');
        $this->db->where('a.token', $token);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_multi_media_users( $token )
    {
        $this->db->select('b.id,b.type,b.month,b.week,b.day,b.url,a.is_checked');
        $this->db->from('multi_media_users AS a');
        $this->db->join('multi_media AS b', 'b.id = a.multi_media_id');
        //$this->db->where('a.is_checked', 0);
        $this->db->where('b.token', $token);
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        #$this->db->order_by('b.type','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
    / Se valida el video como visto
    */


    public function get_indice()
    {
        $this->db->select('COUNT(*) AS cant_module');
        $this->db->from('history_user AS a');
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->row();
    }

    public function ordinales( $indice )
    {
        $this->db->select('a.name');
        $this->db->from('ordinales AS a');
        $this->db->where('a.id', $indice);
        $query = $this->db->get();
        return $query->row();
    }

    public function is_checked($array)
    {
        $this->db->where('multi_media_id', $array['multi_media_id']);
        $fields = array(
            'is_checked' => $array['is_checked'],
            'request_a' => $array['request_a'],
            'request_b' => $array['request_b'],
        );
        $this->db->update('multi_media_users', $fields );
    }
    
    public function show_content( $post )
    {
        $this->db->select('b.*,b.id,a.is_checked');
        $this->db->from('multi_media_users AS a');
        $this->db->join('multi_media AS b', 'b.id = a.multi_media_id');
        //$this->db->where('a.is_checked', 0);
        #$this->db->where('b.week', $post['week']);
        $this->db->where('b.id', $post['id']);
        $this->db->where('b.token', $post['token']);
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->row();
    }

    public function show_content_courses( $post )
    {
        $this->db->select('b.*,b.id,a.is_checked');
        $this->db->from('multi_media_users AS a');
        $this->db->join('multi_media AS b', 'b.id = a.multi_media_id');
        //$this->db->where('a.is_checked', 0);
        #$this->db->where('b.week', $post['week']);
        $this->db->where('b.id', $post['id']);
        $this->db->where('b.token', $post['token']);
        $query = $this->db->get();
        return $query->row();
    }

    // Conteo de lecciones segun el curso y el usuario
    public function count_lesson( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('multi_media_users AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        #$this->db->where('a.is_checked', 1);
        $query = $this->db->get();
        return $query->row();
    }

    // Conteo de lecciones segun el curso y el usuario para el tema de los logros
    public function count_lesson_logros( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('history_logros AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.type', 18);
        $query = $this->db->get();
        return $query->row();
    }


    // Logro por (Completar primer leccion)
    public function primer_leccion( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('history_logros AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.type', 2);
        $query = $this->db->get();
        return $query->row();
    }

    // Registro de historial de logros
    public function history_logros( $data ) {
        $this->db->insert('history_logros', $data);
        #return $this->db->insert_id();
        // Bloque para registar puntaje si cumplio la totalidad de cursos,
        // segun la suma de las lecciones
        $r1 = $this->count_lesson( $data['user_id'], $data['course_id'] );
        $r1 = $r1->can;
        $r2 = $this->count_lesson_logros( $data['user_id'], $data['course_id'] );
        $r2 = $r2->can;

        $first_lesson = $this->primer_leccion( $data['user_id'], $data['course_id'] )->can;

        if( $first_lesson == 0 ){
            $history_logros['user_id']   = $this->session->userdata('user_id');
            $history_logros['course_id'] = $data['course_id'];
            $history_logros['lesson_id'] = $data['lesson_id'];
            $history_logros['type']      = 2;
            $this->db->insert('history_logros', $history_logros);
        }

        if( $r1 > 0 && $r1 == $r2 ){
            // Registro de logro segun halla completado el curso
            // Registro de historial de logros
            $history_logros['user_id']   = $this->session->userdata('user_id');
            $history_logros['course_id'] = $data['course_id'];
            $history_logros['lesson_id'] = $data['lesson_id'];
            $history_logros['type']      = 1;
            $this->db->insert('history_logros', $history_logros);
        }

    }

    public function history_user( $data ) {
        $this->db->insert('history_user', $data);
        return $this->db->insert_id();
    }


    /**
    / Se consulta el historial de usuario
    */
    public function is_checked_history_user( $module_id, $sum_modules, $name)
    {   

        $data_history['name']           = $name;
        $data_history['sum_modules']    = $sum_modules;
        $data_history['multi_media_id'] = 0;
        $data_history['user_id']        = $this->session->userdata('user_id');
        $data_history['module_id']      = $module_id;
        $this->db->insert('history_user', $data_history);

        $this->db->where('module_id', $module_id);
        $this->db->where('is_checked', 0);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $fields = array(
            'is_checked' => 1
        );
        $this->db->update('history_user', $fields );

        // Se inserta las puntuaciones
        $wallet = array(
            'value' => 1, 
            'user_id' => $this->session->userdata('user_id')
        );
        $this->db->insert('wallet', $wallet);
    }

    // Consulta de todos los modulos
    public function module_all()
    {
        $this->db->select('COUNT(*) AS cant');
        $this->db->from('wallet AS a');
        $this->db->where('a.module', 'all');
        $query = $this->db->get();
        return $query->row();
    }

    // Conteo de valorCoin
    public function wallet()
    {
        $this->db->select('SUM(b.valorCoin) AS cant');
        $this->db->from('history_logros AS a');
        $this->db->join('reglas_logros AS b', 'b.id = a.type');
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        #$this->db->order_by('a.id','ASC');
        $query = $this->db->get();
        return $query->row();
    }

    public function children()
    {
        $this->db->select('id, title');
        $this->db->from('course AS a');
        $this->db->where('a.is_free_course', 1);
        $query = $this->db->get();
        return $query->result();
    }

    // Conteo de ValorExp
    public function ValorExp()
    {
        $this->db->select('SUM(b.ValorExp) AS cant');
        $this->db->from('history_logros AS a');
        $this->db->join('reglas_logros AS b', 'b.id = a.type');
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        #$this->db->order_by('a.id','ASC');
        $query = $this->db->get();
        return $query->row();
    }

    // Mostrar en el frontend los logros que lleva el estudiante
    public function showLogros()
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

    /**
    / Se verifica si ya fue verificado el modulo como completado
    */
    public function verify_history_user($module_id)
    {
        $this->db->select('COUNT(a.id) AS verify');
        $this->db->from('history_user AS a');
        $this->db->where('a.is_checked', 0);
        $this->db->where('a.module_id', $module_id);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->row();
    }

    /**
    / Se comprueba si ya fue verificado
    */
    public function count_history_user()
    {
        $this->db->select('COUNT(a.id) AS verify');
        $this->db->from('history_user AS a');
        $this->db->where('a.is_checked', 1);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result();
    }

    /**
    / Sumatoria general de todos los modulos logrados por el usuario
    */
    public function count_all_history_user()
    {
        $this->db->select('SUM(a.sum_modules) AS sum_modules');
        $this->db->from('history_user AS a');
        $this->db->where( 'a.multi_media_id', 0 );
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->row();
    }

    // Consulta sobre la cantidad de cursos completados
    public function sum_history_user()
    {
        $this->db->select('SUM(a.sum_modules) AS cant');
        $this->db->from('history_user AS a');
        $this->db->where( 'a.multi_media_id', 0 );
        $this->db->where('a.is_checked', 1);
        $this->db->where('a.close', 0);
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->row();
    }

    // Consulta sobre la cantidad de cursos completados
    public function count_relation_course_user()
    {
        $this->db->select('COUNT(a.id) AS cant');
        $this->db->from('enroll AS a');
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->row();
    }

    // Consulta para hacer conteo de todas las lecciones por usurio
    public function verify_lesson( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('multi_media_users AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $query = $this->db->get();
        return $query->row();
    }

    // Consulta para comprobar si el usuario cumple con todas las lecciones
    public function verify_lesson_is_checked( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('multi_media_users AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.is_checked', 1);
        $query = $this->db->get();
        return $query->row();
    }

    
    // Consulta para comprobar si el usuario cumple la evaluacion
    public function verify_doc_yes( $user_id, $course_id )
    {
        $this->db->select('a.id,COUNT(*) AS can');
        $this->db->from('doc AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.yes', 1);
        $query = $this->db->get();
        return $query->row();
    }

    // Lista de documentos
    public function list_docs( $user_id )
    {
        /*$this->db->select('*');
        $this->db->from('doc AS a');
        $this->db->where('a.user_id', $user_id);
        $query = $this->db->get();
        return $query->result();*/
        $this->db->select('a.*,b.title AS course');
        $this->db->from('doc AS a');
        $this->db->join('course AS b', 'a.course_id = b.id');
        $this->db->where('a.user_id', $user_id);
        #$this->db->order_by('a.id','ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_doc( $id )
    {
        $this->db->select('*');
        $this->db->from('doc AS a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Verificacion si existe una leccion
    public function verify_is_lesson($data)
    {
        $this->db->select('COUNT(a.id) AS verify');
        $this->db->from('multi_media_users AS a');
        $this->db->where('a.is_checked', $data['is_checked']);
        $this->db->where('a.user_id', $data['user_id']);
        $this->db->where('a.course_id', $data['course_id']);
        $this->db->where('a.multi_media_id', $data['multi_media_id']);
        $query = $this->db->get();
        return $query->row();
    }

    /////////////////////////////////////////////////////////////////////////
    //                               NIVELES
    /////////////////////////////////////////////////////////////////////////

    public function level(){

        $poin = $this->ValorExp()->cant;
        
        if( $poin >= 0 && $poin <= 499 ){
            $nivel = 1;
        }else if( $poin >= 500 && $poin <= 999 ){
            $nivel = 2;
        }else if( $poin >= 1000 && $poin <= 1499 ){
            $nivel = 3;
        }else if( $poin >= 1500 && $poin <= 1999 ){
            $nivel = 4;
        }else if( $poin >= 2000 && $poin <= 2499 ){
            $nivel = 5;
        }else if( $poin >= 2500 && $poin <= 2999 ){
            $nivel = 6;
        }else if( $poin >= 3000 && $poin <= 3499 ){
            $nivel = 7;
        }else if( $poin >= 3500 && $poin <= 3999 ){
            $nivel = 8;
        }else if( $poin >= 4000 && $poin <= 4499 ){
            $nivel = 9;
        }else if( $poin >= 4500 && $poin <= 5000 ){
            $nivel = 10;
        }else{
            $nivel = 10;
        }

        return $nivel;

    }

    /////////////////////////////////////////////////////////////////////////
      

}
