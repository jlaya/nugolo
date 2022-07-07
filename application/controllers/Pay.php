<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        #$this->load->database();
        #$this->load->model('Payu_model');
    }

    // Pasarela de Payu
    public function payu() {
        
        echo "payu";

    }

}
