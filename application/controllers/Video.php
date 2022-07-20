<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->model('Media_model');
    }

    public function multi_media( $token = "" ) {
        $data['groupBy'] = $this->Media_model->get_group_media( $token );
        $data['obj']     = $this->Media_model->get_media( $token );
        $this->load->view('backend/admin/video/index', $data );
    }

    public function register() {


        $data = html_escape($this->input->post());
        $url  = $data['url'];

        $html ='<div style="width: 100%;">';
            $html .='<div style="position: relative; padding-bottom: 56.25%; padding-top: 0; height: 0;">';
                $html .='<iframe frameborder="0" width="1200px" height="675px" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="'.$url.'" type="text/html" allowscriptaccess="always" allowfullscreen="true" scrolling="yes" allownetworking="all">';
                $html .='</iframe>';
            $html .='</div>';
        $html .='</div>';

        $data['embed'] = $html;

        $this->Media_model->multi_media($data);
        
        redirect(site_url('Video/multi_media/'.$data['token']), 'refresh');
    }

    public function delete( $id, $token ) {

        $this->Media_model->delete( $id );
        
        redirect(site_url('Video/multi_media/'.$token), 'refresh');
    }

    /**
    / Se valida el video como visto
    */

    private function ordinales( $indice ) {

        return $this->Media_model->ordinales( $indice );
    }

    // Validar si ya existe alguna leccion
    private function verify_is_lesson( $data ) {
        return $this->Media_model->verify_is_lesson( $data );
    }

    public function is_checked( $total_module_all ) {

        $data = html_escape($this->input->post());

        // Aqui se identifica los numeros ordinales
        $indice = $this->Media_model->get_indice()->cant_module;
        #echo $indice = ( $indice == 0 ? 1: $indice + 1 );
        $indice = ( $indice == 0 ? 1: $indice + 1 );

        #exit;

        $name = $this->ordinales($indice)->name;

        $verify = array(
            'is_checked' => 1,
            'user_id' => $this->session->userdata('user_id'),
            'course_id' => $data['course_id'],
            'multi_media_id' => $data['multi_media_id']
        );

        $url                     = $data['url'];
        $array['multi_media_id'] = $data['multi_media_id'];
        $array['is_checked']     = $data['is_checked'];
        $array['request_a']      = "N/A";
        $array['request_b']      = "N/A";

        $verify_lesson = $this->verify_is_lesson($verify)->verify;
        
        if( $verify_lesson > 0 ){
            redirect($url."?r=1", 'refresh');   
        }
        
        $this->Media_model->is_checked($array);

        // Registro de historial de logros
        $history_logros['user_id']   = $this->session->userdata('user_id');
        $history_logros['course_id'] = $data['course_id'];
        $history_logros['lesson_id'] = $data['multi_media_id'];
        $history_logros['type']      = 18;
        $this->Media_model->history_logros($history_logros);


        // Ingreso de historial de usuario
        //if( $data['sum_modules'] !='' ){
        $data_history['name']           = "Ha logrado su $name modulo";
        $data_history['sum_modules']    = $data['sum_modules'];
        $data_history['multi_media_id'] = $data['multi_media_id'];
        $data_history['user_id']        = $this->session->userdata('user_id');
        $data_history['module_id']      = $data['module_id'];
        $this->Media_model->history_user($data_history);
        //}
        
        redirect($url."?q=message", 'refresh');
    }

}
