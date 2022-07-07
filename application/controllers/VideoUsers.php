<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VideoUsers extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        $this->load->model('VideoUsers_model');
    }

    public function progressbar() {

        $X = $this->VideoUsers_model->viewed(); #videos vistos
        $Y = $this->VideoUsers_model->all_multi_media_users(); #cantidad de videos 100%
        if( $X == 0 && $Y == 0 ){
            $result = 0;
        }else{
            $result = ($X * 100) / $Y;
        }
        $round = round( $result , 2 );
        $progress = "";
        if( !is_nan($round) ){

            $progress .='<div id="progress_bar" class="ui-progress-bar ui-container">';
                $progress .='<div class="ui-progress" style="width: '.$round.'%;">';
                    $progress .='<span class="ui-label" style="display:block;"><b class="value">'.$round.'%</b></span>';
                $progress .='</div>';
            $progress .='<small style="color:red;margin-left: 5% !important;">Vistos ('.$X.')</small>';
            $progress .='</div>';

        }else{
            $progress = "";
        }


        echo $progress;


    }

    public function register() {

        $data['user_id']        = $this->session->userdata('user_id');
        $data['videoId']        = $this->input->post('ready_videoId');
        $data['current']        = $this->input->post('current');
        $data['duration']       = $this->input->post('duration');
        $data['viewed']         = $this->input->post('viewed');
        $data['multi_media_id'] = $this->input->post('multi_media_id');
        $data['datetime']       = date('Y-m-d H:i:s');

        $arraydata = array(
                'videoId'   => $data['videoId'],
                'get_token' => $this->input->post('get_token')
        );
        $this->session->set_userdata($arraydata);

        echo $this->VideoUsers_model->register($data);


    }

    public function show_items() {

        $token = $this->input->get('get_token');

        $obj   = $this->VideoUsers_model->show_items( $token );
        $html  = "";
        foreach ($obj as $key => $value) {

            $id       = $value->id;
            $url      = "'".explode('=', $value->url)[1]."'";
            $viewed   = $value->viewed;
            $title    = $value->title;
            $current  = $value->current;
            $duration = $value->duration;
            $background_color = "";
            $color    = "";

            if( $viewed == 1 && $current == "0:00" && $duration == "0:00" ){
                $background_color = "white";
                $color = "#424953";
            }else if( $viewed == 1 && $current != $duration ){
                $background_color = "silver";
                $color = "#424953";
            }else if( $viewed == 1 && $current == $duration ){
                $background_color = "green";
                $color = "#FFFFFF";
            }
            
            $html.="<li style='background-color: ".$background_color.";padding: 4% 4% 4% 4%;color:".$color."'>";
                $html.='<a onclick="get_video('.$id.','.$url.')" style="cursor: pointer;" >';
                  $html.= $title;
                $html.="</a>";
            $html.="</li>";
        }

        echo $html;
    }

}
