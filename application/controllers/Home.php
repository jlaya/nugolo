<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Announce_model');
        $this->load->model('Matriculation_model');
        $this->load->model('Media_model');
        $this->load->model('Insignias_model');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }
    }


    // Logro por (completar 2 cursos)
    public function completar_2_cursos( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('history_logros AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.type', 11);
        $query1 = $this->db->get();
        $result = $query1->row()->can;

        if( $result == 0 ){

            // Se pregunta si el estudiante tiene 2 cursos
            $this->db->select('COUNT(*) AS can');
            $this->db->from('history_logros AS a');
            $this->db->where('a.user_id', $user_id);
            $this->db->where('a.type', 1);
            $query2 = $this->db->get();
            $two_courses = $query2->row()->can;
                
            if( $two_courses == 2 ){
                #echo "aqui register";
                $history_logros['user_id']   = $user_id;
                $history_logros['course_id'] = 0;
                $history_logros['lesson_id'] = 0;
                $history_logros['type']      = 11;
                $this->db->insert('history_logros', $history_logros);
            }

        }

    }

    // Logro por (completar 3 cursos)
    public function completar_3_cursos( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('history_logros AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.type', 12);
        $query1 = $this->db->get();
        $result = $query1->row()->can;

        if( $result == 0 ){

            // Se pregunta si el estudiante tiene 3 cursos
            $this->db->select('COUNT(*) AS can');
            $this->db->from('history_logros AS a');
            $this->db->where('a.user_id', $user_id);
            $this->db->where('a.type', 1);
            $query2 = $this->db->get();
            $count_courses = $query2->row()->can;
                
            if( $count_courses == 3 ){
                #echo "aqui register";
                $history_logros['user_id']   = $user_id;
                $history_logros['course_id'] = 0;
                $history_logros['lesson_id'] = 0;
                $history_logros['type']      = 12;
                $this->db->insert('history_logros', $history_logros);
            }

        }

    }

    // Logro por (completar 4 cursos)
    public function completar_4_cursos( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('history_logros AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.type', 13);
        $query1 = $this->db->get();
        $result = $query1->row()->can;

        if( $result == 0 ){

            // Se pregunta si el estudiante tiene 4 cursos
            $this->db->select('COUNT(*) AS can');
            $this->db->from('history_logros AS a');
            $this->db->where('a.user_id', $user_id);
            $this->db->where('a.type', 1);
            $query2 = $this->db->get();
            $count_courses = $query2->row()->can;
                
            if( $count_courses == 4 ){
                #echo "aqui register";
                $history_logros['user_id']   = $user_id;
                $history_logros['course_id'] = 0;
                $history_logros['lesson_id'] = 0;
                $history_logros['type']      = 13;
                $this->db->insert('history_logros', $history_logros);
            }

        }

    }

    // Logro por (Logro especial por completar mas de 4 cursos)
    public function completar_mas_4_cursos( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('history_logros AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.type', 14);
        $query1 = $this->db->get();
        $result = $query1->row()->can;

        if( $result == 0 ){

            // Se pregunta si el estudiante tiene 4 cursos
            $this->db->select('COUNT(*) AS can');
            $this->db->from('history_logros AS a');
            $this->db->where('a.user_id', $user_id);
            $this->db->where('a.type', 1);
            $query2 = $this->db->get();
            $count_courses = $query2->row()->can;
                
            if( $count_courses > 4 ){
                #echo "aqui register";
                $history_logros['user_id']   = $user_id;
                $history_logros['course_id'] = 0;
                $history_logros['lesson_id'] = 0;
                $history_logros['type']      = 14;
                $this->db->insert('history_logros', $history_logros);
            }

        }

    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $this->completar_2_cursos( $user_id, 0 );
        $this->completar_3_cursos( $user_id, 0 );
        $this->completar_4_cursos( $user_id, 0 );
        $this->completar_mas_4_cursos( $user_id, 0 );
        $this->home();
    }


    //Lista de cursos
    public function courses() {
        $page_data['page_name'] = "home-public";
        $page_data['page_title'] = "Cursos";
        $this->load->view('frontend/default/index', $page_data);
    }

    public function home() {
        $page_data['page_name']  = "home";
        $page_data['page_title'] = get_phrase('home');
        $page_data['announce']   = $this->Announce_model->show_public();
        $page_data['matriculation'] = $this->Matriculation_model->show();
        $page_data['verify_matriculation'] = $this->Matriculation_model->verify_matriculation();
        
        if($this->session->userdata('user_id') !=""){
            $this->load->view('frontend/default/index-landigpage', $page_data);
        }else{
            redirect(site_url('login'), 'refresh');
        }
    }

    public function contact() {
        $page_data['page_name'] = "contact";
        $page_data['page_title'] = "Contacto";
        $this->load->view('frontend/default/index', $page_data);
    }

    // E-mail
    public function send_email( $from, $message ) {
        
        //SMTP & mail configuration
        $this->load->library('email');
        $config = array(
            'protocol'  => get_settings('protocol'),
            'smtp_host' => 'ssl://'.get_settings('smtp_host'),
            'smtp_port' => get_settings('smtp_port'),
            'smtp_user' => get_settings('smtp_user'),
            'smtp_pass' => get_settings('smtp_pass'),
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        
        $this->email->set_newline("\r\n");
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        

        $htmlContent = $message;

        $this->email->to(get_settings('smtp_user'));
        $this->email->from($from, get_settings('system_name'));
        $this->email->subject("GyM");
        $this->email->message($htmlContent);
        //Send email
        $this->email->send();
        
        /*if($this->email->send(FALSE)){
             echo "enviado<br/>";
             echo $this->email->print_debugger(array('headers'));
         }else {
             echo "fallo <br/>";
             echo "error: ".$this->email->print_debugger(array('headers'));
         }*/

    }

    public function contact_add() {
        $data = $this->input->post();
        $data['datetime'] = date('Y-m-d H:i:s');
        $result = $this->db->insert('contact', $data);
        if( $result ){
            $this->send_email( $data['email'], $data['message'] );
        }
        redirect(site_url('contact'), 'refresh');
    }

    public function shopping_cart() {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }
        $page_data['page_name'] = "shopping_cart";
        $page_data['page_title'] = get_phrase('shopping_cart');
        $this->load->view('frontend/default/index', $page_data);
    }

    public function category($slug = "", $sub_category_id = "") {
        $checker = array();
        if ($sub_category_id > 0) {
            $page_data['sub_category_id'] = $sub_category_id;
            $sub_category_details = $this->crud_model->get_category_details_by_id($sub_category_id)->row_array();
            $category_details     = $this->crud_model->get_categories($sub_category_details['parent'])->row_array();
            $checker = array(
                'category_id'     => $category_details['id'],
                'sub_category_id' => $sub_category_details['id']
            );
        }
        $this->db->where($checker);
        $this->db->where('status', 'active');
        $total_rows = $this->db->get('course')->num_rows();
        $config = array();
        $config = pagintaion($total_rows, 10);
        $config['base_url']  = site_url('home/category/'.$slug.'/'.$sub_category_id.'/');
        $this->pagination->initialize($config);

        $page_data['page_name']       = "category_page";
        $page_data['page_title']      = get_phrase('category_page');
        $page_data['per_page']        = $config['per_page'];
        $this->load->view('frontend/default/index', $page_data);
    }

    public function all_category() {
        $this->db->where('status', 'active');
        $total_rows = $this->db->get('course')->num_rows();
        $config = array();
        $config = pagintaion($total_rows, 3);
        $config['base_url']  = site_url('home/all_category/');
        $this->pagination->initialize($config);

        $page_data['page_name']       = "all_category_page";
        $page_data['page_title']      = get_phrase('all_categories');
        $page_data['per_page']        = $config['per_page'];
        $this->load->view('frontend/default/index', $page_data);
    }

    public function course($slug = "", $course_id = "") {
        $page_data['course_id'] = $course_id;

        if( $this->session->userdata('user_login') == '' ){
            $page_data['page_name'] = "course_page-public";
        }else{
            $page_data['page_name'] = "course_page";
        }

        $page_data['page_title'] = get_phrase('course');
        $this->load->view('frontend/default/index', $page_data);
    }

    public function instructor($instructor_id = "") {
        $page_data['page_name'] = "instructor_page";
        $page_data['page_title'] = get_phrase('instructor_page');
        $page_data['instructor_id'] = $instructor_id;
        $this->load->view('frontend/default/index', $page_data);
    }

    public function my_courses() {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('home'), 'refresh');
        }
        $page_data['page_name'] = "my_courses";
        $page_data['page_title'] = get_phrase("my_courses");
        $this->load->view('frontend/default/index', $page_data);
    }

    public function my_messages($param1 = "", $param2 = "") {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('home'), 'refresh');
        }
        if ($param1 == 'read_message') {
            $page_data['message_thread_code'] = $param2;
        }
        elseif ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(site_url('home/my_messages/read_message/' . $message_thread_code), 'refresh');
        }
        elseif ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2); //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(site_url('home/my_messages/read_message/' . $param2), 'refresh');
        }
        $page_data['page_name'] = "my_messages";
        $page_data['page_title'] = get_phrase('my_messages');
        $this->load->view('frontend/default/index', $page_data);
    }

    public function my_notifications() {
        $page_data['page_name'] = "my_notifications";
        $page_data['page_title'] = get_phrase('my_notifications');
        $this->load->view('frontend/default/index', $page_data);
    }

    public function my_wishlist() {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }
        $my_courses = $this->crud_model->get_courses_by_wishlists();
        $page_data['my_courses'] = $my_courses;
        $page_data['page_name'] = "my_wishlist";
        $page_data['page_title'] = get_phrase('my_wishlist');
        $this->load->view('frontend/default/index', $page_data);
    }

    public function purchase_history() {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('home'), 'refresh');
        }

        $total_rows = $this->crud_model->purchase_history($this->session->userdata('user_id'))->num_rows();
        $config = array();
        $config = pagintaion($total_rows, 3);
        $config['base_url']  = site_url('home/purchase_history');
        $this->pagination->initialize($config);
        $page_data['per_page']   = $config['per_page'];
        $page_data['page_name']  = "purchase_history";
        $page_data['page_title'] = get_phrase('purchase_history');
        $this->load->view('frontend/default/index', $page_data);
    }

    public function profile($param1 = "") {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('home'), 'refresh');
        }

        if ($param1 == 'users') {
            $page_data['page_name'] = "user_profile";
            $page_data['page_title'] = get_phrase('user_profile');
        }elseif ($param1 == 'credentials') {
            $page_data['page_name'] = "user_credentials";
            $page_data['page_title'] = get_phrase('credentials');
        }elseif ($param1 == 'user_photo') {
            $page_data['page_name'] = "update_user_photo";
            $page_data['page_title'] = get_phrase('update_user_photo');
        }
        $page_data['user_details'] = $this->user_model->get_user($this->session->userdata('user_id'));
        $this->load->view('frontend/default/index', $page_data);
    }

    public function update_profile($param1 = "") {
        if ($param1 == 'update_basics') {
            $this->user_model->edit_user($this->session->userdata('user_id'));
        }elseif ($param1 == "update_credentials") {
            $this->user_model->update_account_settings($this->session->userdata('user_id'));
        }elseif ($param1 == "update_photo") {
            $this->user_model->upload_user_image($this->session->userdata('user_id'));
            $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        }elseif ($param1 == "update_payment_settings") {
            $this->user_model->update_instructor_payment_settings($this->session->userdata('user_id'));
            $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
            redirect(site_url('home/dashboard/payment_settings'), 'refresh');
        }
        redirect(site_url('home/profile/users'), 'refresh');
    }

    public function handleWishList() {
        if ($this->session->userdata('user_login') != 1) {
            echo false;
        }else {
            if (isset($_POST['course_id'])) {
                $course_id = $this->input->post('course_id');
                $this->crud_model->handleWishList($course_id);
            }
            $this->load->view('frontend/default/wishlist_items');
        }
    }
    public function handleCartItems() {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }

        $course_id = $this->input->post('course_id');
        $previous_cart_items = $this->session->userdata('cart_items');
        if (in_array($course_id, $previous_cart_items)) {
            $key = array_search($course_id, $previous_cart_items);
            unset($previous_cart_items[$key]);
        }else {
            array_push($previous_cart_items, $course_id);
        }

        $this->session->set_userdata('cart_items', $previous_cart_items);
        $this->load->view('frontend/default/cart_items');
    }

    public function handleCartItemForBuyNowButton() {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }

        $course_id = $this->input->post('course_id');
        $previous_cart_items = $this->session->userdata('cart_items');
        if (!in_array($course_id, $previous_cart_items)) {
            array_push($previous_cart_items, $course_id);
        }
        $this->session->set_userdata('cart_items', $previous_cart_items);
        $this->load->view('frontend/default/cart_items');
    }

    public function refreshWishList() {
        $this->load->view('frontend/default/wishlist_items');
    }

    public function refreshShoppingCart() {
        $this->load->view('frontend/default/shopping_cart_inner_view');
    }

    public function isLoggedIn() {
        if ($this->session->userdata('user_login') == 1)
            echo true;
        else
            echo false;
    }

    public function paypal_checkout() {
        if ($this->session->userdata('user_login') != 1)
            redirect('home', 'refresh');

        $total_price_of_checking_out  = $this->input->post('total_price_of_checking_out');
        $page_data['user_details']    = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
        $page_data['amount_to_pay']   = $total_price_of_checking_out;
        $this->load->view('frontend/default/paypal_checkout', $page_data);
    }
    function validarTarjeta($num_tarjeta) {
        $num_tarjeta = preg_replace("/\D|\s/", "", $num_tarjeta);
        $length = strlen($num_tarjeta);

        $parity = $length % 2;
        $sum = 0;

        for ($i = 0; $i < $length; $i++) {
            $digit = $num_tarjeta [$i];
            if ($i % 2 == $parity)
                $digit = $digit * 2;
            if ($digit > 9)
                $digit = $digit - 9;
            $sum = $sum + $digit;
        }

        return ($sum % 10 == 0);
    }

    public function getTipoTarjeta($cc) {


        $cards = array(
            "visa" => "(4\d{12}(?:\d{3})?)",
            "amex" => "(3 [47] \d{13})",
            "jcb" => "(35 [2-8] [89] \d\d\d{10})",
            "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
            "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
            "mastercard" => "(5 [1-5] \d{14})",
            "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
        );

        $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch");

        $matches = array();

        $pattern = "#^(?:" . implode("|", $cards) . ")$#";


        $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);

        if ($result > 0) {
            $result = ($this->validarTarjeta($cc)) ? 1 : 0;
        }

        return ($result > 0) ? $names [sizeof($matches) - 2] : false;
    }
    public function paguelofacil(){ 
        if ($this->session->userdata('user_login') != 1)
            redirect('home', 'refresh');
        $total_price_of_checking_out  = $this->input->post('total_price_of_checking_out');

        $name=$this->input->post('first-name');
        $lastname=$this->input->post('last-name');
        $card=str_replace(" ", "", $this->input->post('number'));

        $cvc=str_replace(" ", "", $this->input->post('cvc'));

        $credi_card_expiry = explode('/', $this->input->post('expiry'));
        $credi_card_year = str_replace(" ", "", $credi_card_expiry[1]);
        if (strlen($credi_card_year)>2) {
            $credi_card_year = substr($credi_card_year,-2);
        }

        $credi_card_month = str_replace(" ", "", $credi_card_expiry[0]);

        $credit_card_TipoTarjeta = ($this->getTipoTarjeta($card) == 'Visa') ? 'VISA' : 'MC';
        $email = $this->input->post('email');
        $telefono = $this->input->post('phone');
        $address = $this->input->post('address');


        $paguelo_info = json_decode(get_settings('paguelofacil'), true);
        $cclw = $paguelo_info[0]['CCLW'];
        $paguelo_info[0]['onsite']=0;
       
        
        if($paguelo_info[0]['onsite']==0){
            $url = $paguelo_info[0]['url'];
            $secred = $card.$cvc.$email;
            $orden=substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 5);
            $data = array(
                "CCLW" =>  $cclw ,
                "txType" => 'SALE',
                "CMTN" => $total_price_of_checking_out,
                "CDSC" => 'Orden Nro. PF'. $orden,
                "CCNum" => $card,
                "ExpMonth" => $credi_card_month,
                "ExpYear" => $credi_card_year,
                "CVV2" => $cvc,
                "Name" => $name,
                "LastName" => $lastname,
                "Email" => $email,
                "Address" => $address,
                "Tel" => $telefono,
                "SecretHash" => hash('sha512', $secred),
            );
            $postR="";            
            foreach($data as $mk=>$mv)
            {
                $postR .= "&".$mk."=".$mv;
            }
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','Accept: */*'));
            curl_setopt($ch,CURLOPT_POSTFIELDS,$postR);
            $result = curl_exec($ch);
            setlocale(LC_TIME, 'es_PA.UTF-8');
            $fecha=( strftime("%A, %d de %B del %Y",  mktime(0, 0, 0, date("m")  , date("d"), date("Y"))));
            $datapf['course_id']=json_encode($this->session->userdata('cart_items'));
            $datapf['user_id']=json_decode($this->session->userdata('user_id'), true);
            $datapf['address']=$address;
            $datapf['ip']=$this->getRealIP();
            $datapf['fact_num']='';
            if ($result === FALSE) {
                $datapf['data_transaction']=$result;
                $datapf['address']='';
                $this->crud_model->set_transactionPF($datapf);
                $regresa= ['code'=>500,'error'=>1, 'mensaje' => get_phrase('payment_successfully_down')];
            }else{
                $datapf['data_transaction']=$result;
                $result = json_decode($result, true);
                
                curl_close($ch);
                if($result['Status']=='Approved'){
                    $datapf['fact_num']=$orden;
                        $cursos=$this->crud_model->get_courses_by_id($this->session->userdata('cart_items'))->result_array();
                        $table_cursos='<style type="text/css">
                        .tg{border-collapse:collapse;border-spacing:0;border-color:#ccc;}
                        .tg td{font-size:14px;padding:0px 0px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;border-color:#ccc;color:#333;background-color:#fff;}
                        .tg th{font-size:14px;font-weight:normal;padding:0px 0px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;border-color:#ccc;color:#333;background-color:#fefefe;}
                        .tg .tg-mkcl{font-size:16px;border-color:#c0c0c0;text-align:left;border-width:0}
                        .tg .tg-5yjp{font-weight:bold;font-size:16px;border-color:#c0c0c0;text-align:right;border-bottom-width:0}
                        .tg .tg-226c{background-color:#fff;font-size:16px;border-color:#c0c0c0;text-align:right}
                        .tg .tg-226c1{background-color:#fff;font-size:16px;border-color:#c0c0c0;text-align:left}
                        .tg .tg-wy8l{background-color:#fefefe;font-size:16px;border-color:#c0c0c0;border-top-width:0;text-align:left}
                        .tg .tg-wy8l1{background-color:#fefefe;font-size:16px;border-color:#c0c0c0;border-top-width:0;text-align:right}
                        .tg .tg-3mto{font-weight:bold;font-size:16px;border-color:#c0c0c0;text-align:left}
                        .tg .tg-grge{font-weight:bold;font-size:16px;border-color:#c0c0c0;text-align:right}
                        .tg  td {                          
                          vertical-align:middle;
                          height: 1.75rem;
                        }   
                        </style>';
                        foreach ($cursos as $curso):
                            $table_cursosd .= '<tr><td  class="tg-226c1">' . $curso['title'] . '&nbsp;&nbsp;</td><td class="tg-226c">$' . number_format((($curso['discount_flag']==1)?$curso['discounted_price']:$curso['price']), 2) . '</td></tr>';
                        endforeach;
                        $table_cursos.='<table class="tg" width="100%">
                          <tr>
                            <th class="tg-mkcl" colspan="2">'.$name.' '.$lastname.'<br>Panamá '.$fecha.'<br></th>
                          </tr>
                          <tr>
                            <td class="tg-wy8l">Paguelo Facil '.$credit_card_TipoTarjeta.'</td>
                            <td class="tg-wy8l1">Recibo de pago N&deg; '.$orden.'</td>
                          </tr>
                          <tr>
                            <td class="tg-3mto">Curso</td>
                            <td class="tg-grge">Precio</td>
                          </tr>
                          '.$table_cursosd.'
                          <tr>
                            <td class="tg-5yjp" colspan="2">Total: $'.number_format($total_price_of_checking_out,2).'</td>
                          </tr>
                        </table>';
                        $body='<p>Hola '.$name.' '.$lastname.'<br>Gracias por tu compra, a continuación encontraras el detalle de tu pago. '.$table_cursos.'</p>';
                    $user_id=$this->session->userdata('user_id');
                    $this->crud_model->enroll_student($user_id);
                    $this->crud_model->course_purchase($user_id, 'Paguelo Facil', $total_price_of_checking_out);
                    $this->session->set_userdata('cart_items', array());
                    $this->session->set_flashdata('flash_message', get_phrase('payment_successfully_done'));
                    $this->email_model->payment_success($body, $email);
                    $this->crud_model->set_transactionPF($datapf);

                    $regresa= ['code'=>200,'error'=>0, 'mensaje' => ''];
                }else{
                    $datapf['fact_num']='';
                    $this->crud_model->set_transactionPF($datapf);
                    $regresa= ['code'=>500,'error'=>2, 'mensaje' => $result['RespText']. ' '.$result['error']];
                }
            }

        }
        echo json_encode($regresa);
        exit();
    }
    public function stripe_checkout() {
        if ($this->session->userdata('user_login') != 1)
            redirect('home', 'refresh');

        $total_price_of_checking_out  = $this->input->post('total_price_of_checking_out');
        $page_data['user_details']    = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
        $page_data['amount_to_pay']   = $total_price_of_checking_out;
        $this->load->view('frontend/default/stripe_checkout', $page_data);

    }

    public function payment_success($method = "", $user_id = "", $amount_paid = "") {
        $this->crud_model->enroll_student($user_id);
        $this->crud_model->course_purchase($user_id, $method, $amount_paid);
        $this->session->set_userdata('cart_items', array());
        $this->session->set_flashdata('flash_message', get_phrase('payment_successfully_done'));
        if ($method == 'stripe') {
            redirect('home', 'refresh');
        }
    }

    public function lesson($slug = "", $course_id = "", $lesson_id = "") {
        if ($this->session->userdata('user_login') != 1){
            if ($this->session->userdata('admin_login') != 1){
              redirect('home', 'refresh');
          }
      }

      $user_id = $this->session->userdata('user_id');
      $this->completar_2_cursos( $user_id, 0 );
      $this->completar_3_cursos( $user_id, 0 );
      $this->completar_4_cursos( $user_id, 0 );
      $this->completar_mas_4_cursos( $user_id, 0 );

      $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
      $page_data['course_id']  = $course_id;
      $page_data['page_name']  = 'my_course_details';
      $page_data['page_title'] = $course_details['title'];
      $page_data['sections']   = json_decode($course_details['section']);
      if (sizeof($page_data['sections']) > 0) {
        if ($lesson_id == "") {
            $default_lesson_details = $this->crud_model->get_default_lesson($page_data['sections'][0])->row_array();
            $page_data['lesson_id']  = $default_lesson_details['id'];
        }else {
            $page_data['lesson_id']  = $lesson_id;
        }
    }else {
        $page_data['page_name'] = 'blank_page';
        $page_data['page_title'] = get_phrase('blank_page');
        $page_data['page_body'] = get_phrase('no_section_found');
    }

    $this->load->view('frontend/default/lesson', $page_data);
}

public function my_courses_by_category() {
    $category_id = $this->input->post('category_id');
    $course_details = $this->crud_model->get_my_courses_by_category_id($category_id)->result_array();
    $page_data['my_courses'] = $course_details;
    $this->load->view('frontend/default/reload_my_courses', $page_data);
}

public function bycourses($search_string = "") {
    if (isset($_POST['search_string'])) {
        $search_string = $this->input->post('search_string');
        redirect(site_url('home/bycourses/'.$search_string), 'refresh');
    }
    $page_data['courses'] = $this->crud_model->get_courses_by_search_string($search_string);
    $page_data['page_name'] = 'course_search_page';
    $page_data['search_string'] = $search_string;
    $page_data['page_title'] = get_phrase('search_results');
    $this->load->view('frontend/default/index', $page_data);
}
public function my_courses_by_search_string() {
    $search_string = $this->input->post('search_string');
    $course_details = $this->crud_model->get_my_courses_by_search_string($search_string)->result_array();
    $page_data['my_courses'] = $course_details;
    $this->load->view('frontend/default/reload_my_courses', $page_data);
}

public function get_my_wishlists_by_search_string() {
    $search_string = $this->input->post('search_string');
    $course_details = $this->crud_model->get_courses_of_wishlists_by_search_string($search_string);
    $page_data['my_courses'] = $course_details;
    $this->load->view('frontend/default/reload_my_wishlists', $page_data);
}

public function reload_my_wishlists() {
  $my_courses = $this->crud_model->get_courses_by_wishlists();
  $page_data['my_courses'] = $my_courses;
  $this->load->view('frontend/default/reload_my_wishlists', $page_data);
}

public function get_course_details() {
    $course_id = $this->input->post('course_id');
    $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
    echo $course_details['title'];
}

public function rate_course() {
    $data['review'] = $this->input->post('review');
    $data['ratable_id'] = $this->input->post('course_id');
    $data['ratable_type'] = 'course';
    $data['rating'] = $this->input->post('starRating');
    $data['date_added'] = strtotime(date('D, d-M-Y'));
    $data['user_id'] = $this->session->userdata('user_id');
    $this->crud_model->rate($data);
}

/**
Quienes Somos | Planes | Contacto
*/
public function about_us() {
    $page_data['page_name'] = 'about_us';
    $page_data['page_title'] = 'Quienes somos';
    $this->load->view('frontend/default/index', $page_data);
}
public function plans() {
    $page_data['page_name'] = 'plans';
    $page_data['page_title'] = 'Planes';
    $this->load->view('frontend/default/index', $page_data);
}

public function terms() {
    $page_data['page_name'] = 'terms_and_condition';
    $page_data['page_title'] = get_phrase('terms_and_condition');
    $this->load->view('frontend/default/index', $page_data);
}

public function privacy() {
    $page_data['page_name'] = 'privacy_policy';
    $page_data['page_title'] = get_phrase('privacy_policy');
    $this->load->view('frontend/default/index', $page_data);
}


    // Version 1.1
public function dashboard($param1 = "") {
    if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
    }

    if ($param1 == "") {
        $page_data['type'] = 'active';
    }else {
        $page_data['type'] = $param1;
    }

    $page_data['page_name']  = 'instructor_dashboard';
    $page_data['page_title'] = get_phrase('instructor_dashboard');
    $page_data['user_id']    = $this->session->userdata('user_id');
    $this->load->view('frontend/default/index', $page_data);
}

public function create_course() {
    if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
    }

    $page_data['page_name'] = 'create_course';
    $page_data['page_title'] = get_phrase('create_course');
    $this->load->view('frontend/default/index', $page_data);
}

public function edit_course($param1 = "", $param2 = "") {
    if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
    }

    if ($param2 == "") {
        $page_data['type']   = 'edit_course';
    }else {
        $page_data['type']   = $param2;
    }
    $page_data['page_name']  = 'manage_course_details';
    $page_data['course_id']  = $param1;
    $page_data['page_title'] = get_phrase('edit_course');
    $this->load->view('frontend/default/index', $page_data);
}

public function course_action($param1 = "", $param2 = "") {
    if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
    }

    if ($param1 == 'create') {
        if (isset($_POST['create_course'])) {
            $this->crud_model->add_course();
            //redirect(site_url('home/create_course'), 'refresh');
            $this->session->set_userdata('course_tab', 'create');
            redirect(site_url('home/dashboard/pending'), 'refresh');
        }else {
            $this->crud_model->add_course('save_to_draft');
            //redirect(site_url('home/create_course'), 'refresh');
            $this->session->set_userdata('course_tab', 'draft');
            redirect(site_url('home/dashboard/draft'), 'refresh');
        }
    }elseif ($param1 == 'edit') {
        if (isset($_POST['publish'])) {
            $this->crud_model->update_course($param2, 'publish');
            redirect(site_url('home/dashboard'), 'refresh');
        }else {
            $this->crud_model->update_course($param2, 'save_to_draft');
            redirect(site_url('home/dashboard'), 'refresh');
        }
    }
}


public function sections($action = "", $course_id = "", $section_id = "") {
    if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
    }

    if ($action == "add") {
        $this->crud_model->add_section($course_id);

    }elseif ($action == "edit") {
        $this->crud_model->edit_section($section_id);

    }elseif ($action == "delete") {
        $this->crud_model->delete_section($course_id, $section_id);
        $this->session->set_flashdata('flash_message', get_phrase('section_deleted'));
        redirect(site_url("home/edit_course/$course_id/manage_section"), 'refresh');

    }elseif ($action == "serialize_section") {
        $container = array();
        $serialization = json_decode($this->input->post('updatedSerialization'));
        foreach ($serialization as $key) {
            array_push($container, $key->id);
        }
        $json = json_encode($container);
        $this->crud_model->serialize_section($course_id, $json);
    }
    $page_data['course_id'] = $course_id;
    $page_data['course_details'] = $this->crud_model->get_course_by_id($course_id)->row_array();
    return $this->load->view('frontend/default/reload_section', $page_data);
}

public function manage_lessons($action = "", $course_id = "", $lesson_id = "") {
    if ($this->session->userdata('user_login') != 1){
        redirect('home', 'refresh');
    }
    if ($action == 'add') {
        $this->crud_model->add_lesson();
        $this->session->set_flashdata('flash_message', get_phrase('lesson_added'));
    }
    elseif ($action == 'edit') {
        $this->crud_model->edit_lesson($lesson_id);
        $this->session->set_flashdata('flash_message', get_phrase('lesson_updated'));
    }
    elseif ($action == 'delete') {
        $this->crud_model->delete_lesson($lesson_id);
        $this->session->set_flashdata('flash_message', get_phrase('lesson_deleted'));
    }
    redirect('home/edit_course/'.$course_id.'/manage_lesson');
}

public function lesson_editing_form($lesson_id = "", $course_id = "") {
  if ($this->session->userdata('user_login') != 1){
      redirect('home', 'refresh');
  }
  $page_data['type']      = 'manage_lesson';
  $page_data['course_id'] = $course_id;
  $page_data['lesson_id'] = $lesson_id;
  $page_data['page_name']  = 'lesson_edit';
  $page_data['page_title'] = get_phrase('update_lesson');
  $this->load->view('frontend/default/index', $page_data);
}

public function download($filename = "") {
    $tmp           = explode('.', $filename);
    $fileExtension = strtolower(end($tmp));
    $yourFile = base_url().'uploads/lesson_files/'.$filename;
    $file = @fopen($yourFile, "rb");

    header('Content-Description: File Transfer');
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename='.$filename);
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($yourFile));
    while (!feof($file)) {
        print(@fread($file, 1024 * 8));
        ob_flush();
        flush();
    }
}

    // Version 1.3 codes
public function get_enrolled_to_free_course($course_id) {
    $this->crud_model->enroll_to_free_course($course_id, $this->session->userdata('user_id'));
    redirect(site_url('home/mycourses'), 'refresh');
}
function getRealIP()
{

    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }

}

public function show_content() {
    $post = $this->input->post();
    $json = $this->Media_model->show_content( $post );
    echo json_encode($json);
}

public function get_modules() {
    $post = $this->input->post();
    $module = $post['module'];
    $token  = $post['token'];
    $json = $this->Media_model->get_modules( $module, $token );
    echo json_encode($json);
}

    ///////////////////////////////////////////////////////////////////////////
    //                                 PAYU
    ///////////////////////////////////////////////////////////////////////////
    
    /**
    Firma de autenticación
    La variable signature es utilizada para validar los pago realizados a través de la plataforma, asegurando su autenticidad. Esta variable es un valor tipo string encriptado utilizando el algoritmo MD5 o el SHA y tiene la siguiente estructura.

    ApiKey~merchantId~referenceCode~tx_value~currency
    
    Doc:

    https://documenter.getpostman.com/view/1825613/S1TZxb5k#7570f029-3cd6-4e79-a6cb-bd53a7a9d9ed


    */

    // Signature
    public function signature($ApiKey,$merchantId,$referenceCode,$tx_value,$currency) {
        
        return md5('$ApiKey~$merchantId~$referenceCode~$tx_value~$currency');

    }

    public function ip() {
      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
      
      return $ip;
    }

    // El método PING te permite verificar la conexión con nuestra plataforma
    public function ping($test){

        $test = config_item("is_active_payu");
        
        if( $test == 'true' ){

            $sandbox  = 'sandbox.';
            $apiLogin = "pRRXKOl8ikMmt9u";
            $ApiKey   = "4Vj8eK4rloUd272L48hsrarnUA";

        }else{

            $sandbox  = '';
            $apiLogin = "KcemIMv5glEB4MM";
            $ApiKey   = "y8v7938NOyOQUu96H6RNa8Haiz";

        }

        $curl = curl_init();
            $url  = "https://".$sandbox."api.payulatam.com/payments-api/4.0/service.cgi";
            $CURLOPT_POSTFIELDS = '{
               "test": '.$test.',
               "language": "en",
               "command": "PING",
               "merchant": {
                  "apiLogin": "'.$apiLogin.'",
                  "apiKey": "'.$ApiKey.'"
               }
            }
            ';

            #echo "<pre>";
            #echo $CURLOPT_POSTFIELDS;
            #exit;

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $CURLOPT_POSTFIELDS,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
                #'Content-Length: length'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo json_encode($response);

    }


    // El método PING te permite verificar la conexión con nuestra plataforma
    public function verify($transactionId){

        $test = config_item("is_active_payu");
        
        if( $test == 'true' ){

            $sandbox  = 'sandbox.';
            $apiLogin = "pRRXKOl8ikMmt9u";
            $ApiKey   = "4Vj8eK4rloUd272L48hsrarnUA";

        }else{

            $sandbox  = '';
            $apiLogin = "KcemIMv5glEB4MM";
            $ApiKey   = "y8v7938NOyOQUu96H6RNa8Haiz";

        }

        $curl = curl_init();
            $url  = "https://".$sandbox."api.payulatam.com/reports-api/4.0/service.cgi";
        $CURLOPT_POSTFIELDS = '{
           "test": '.$test.',
           "language": "en",
           "command": "TRANSACTION_RESPONSE_DETAIL",
           "merchant": {
              "apiLogin": "'.$apiLogin.'",
              "apiKey": "'.$ApiKey.'"
           },
           "details": {
              "transactionId": "'.$transactionId.'"
           }
        }';

        #echo "<pre>";
        #echo $CURLOPT_POSTFIELDS;
        #exit;

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $CURLOPT_POSTFIELDS,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/json'
            #'Content-Length: length'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        #echo "<pre>";
        $response_json = json_decode($response);
        #echo "<pre>";
        #print_r($response);
        $state = $response_json->result->payload->state;

        if( $state == 'APPROVED' ){
            $this->db->where('transactionId', $transactionId);
            $data = array(
                'response' => json_encode($response_json)
            );
            $this->db->update('enroll', $data);
        }else{
            echo "Aun nada";
        }

    }


    // Cron
    public function cron(){

        echo "HOLA JESUS LAYA"; exit;

        $this->db->where('type', 2);
        $this->db->where('response', NULL);
        $query = $this->db->get('enroll');
        $obj = $query->result();

        if( count($obj) > 0 ){
            foreach ($obj as $key => $value) {
                # code...
                $transactionId = $value->transactionId;
                $this->verify($transactionId);
            }
        }

    }


    // Este método retorna la lista de bancos disponibles para realizar pagos utilizando PSE
    public function banks($test){

        $test = config_item("is_active_payu");

        if( $test == 'true' ){

            $sandbox  = 'sandbox.';
            $apiLogin = "pRRXKOl8ikMmt9u";
            $ApiKey   = "4Vj8eK4rloUd272L48hsrarnUA";

        }else{

            $sandbox  = '';
            $apiLogin = "KcemIMv5glEB4MM";
            $ApiKey   = "y8v7938NOyOQUu96H6RNa8Haiz";

        }

        $curl = curl_init();
            $url  = "https://".$sandbox."api.payulatam.com/payments-api/4.0/service.cgi";
            $CURLOPT_POSTFIELDS = '{
               "language": "es",
               "command": "GET_BANKS_LIST",
               "merchant": {
                  "apiLogin": "'.$apiLogin.'",
                  "apiKey": "'.$ApiKey.'"
               },
               "test": '.$test.',
               "bankListInformation": {
                  "paymentMethod": "PSE",
                  "paymentCountry": "CO"
               }
            }
            ';

            #echo "<pre>";
            #echo $CURLOPT_POSTFIELDS;
            #exit;

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $CURLOPT_POSTFIELDS,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
                #'Content-Length: length'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            #echo json_encode($response);
            if( json_encode($response) !=false ){
                $this->crud_model->update_banks($response);
            }

    }

    // Vista de pago donde se presentan los datos al cliente
    public function pay(){

        $date_now = $this->crud_model->get_banks()->date_now;

        /*if( $date_now != date("Y-m-d") ){
            $this->banks(true);
        }*/

        // Consulta de los bancos
        $banks = $this->crud_model->get_json_banks()->json;
        $banks = json_decode($banks)->banks;

        #echo "<pre>";
        #print_r((object)$banks);
        #exit;

        $page_data['page_name']  = 'pay';
        $page_data['page_title'] = 'Pago';
        $page_data['banks']      = (object)$banks;
        $this->load->view('frontend/default/index', $page_data);
    }


    // Pasarela de Payu
    public function payu($method,$test = 'true') {

        // Variable para accionar el entorno de Payu
        $test = config_item("is_active_payu");

        // Datos POST
        $post = $this->input->post();

        #echo "<pre>";
        #print_r($post);
        #exit;

        if( $test == 'true' ){
            $sandbox = 'sandbox.';
            $ApiKey             = "4Vj8eK4rloUd272L48hsrarnUA";
            $apiLogin           = "pRRXKOl8ikMmt9u";
            $merchantId         = "508029";
            $accountId          = "512321";
            $TX_VALUE           = 65000;
            $TX_TAX             = 10378;
            $currency           = "COP";
            $referenceCode      = "PRODUCT_TEST_2021-06-23T19:59:43.229Z";
            $signature          = "1d6c33aed575c4974ad5c0be7c6a1c87";
            // Pago por tarjeta de credito
            $number         = $post['number'];
            $securityCode   = $post['securityCode'];
            $expirationDate = $post['expirationDate'];
            $name           = $post['STATE_PAY'];
            // Para pagos por PSE
            $FINANCIAL_INSTITUTION_CODE = 1022;
            $USER_TYPE                  = "N";
            $PSE_REFERENCE2             = "CC";
            $PSE_REFERENCE3             = 123456789;
        }else if( $test == 'false' ){
            $sandbox = '';
            $ApiKey             = "y8v7938NOyOQUu96H6RNa8Haiz";
            $apiLogin           = "KcemIMv5glEB4MM";
            $merchantId         = "899265";
            $accountId          = "905891";
            $TX_VALUE           = $post['TX_VALUE'];
            $TX_TAX             = 0;
            $currency           = "COP";
            $referenceCode      = md5( rand(10,100).session_id().microtime());
            $signature          = $this->signature($ApiKey,$merchantId,$referenceCode,$TX_VALUE,$currency);
            // Pago por tarjeta de credito
            $number         = $post['number'];
            $securityCode   = $post['securityCode'];
            $expirationDate = $post['expirationDate'];
            $name           = $post['STATE_PAY'];
            // Pagos por PSE
            $FINANCIAL_INSTITUTION_CODE = $post['FINANCIAL_INSTITUTION_CODE'];
            $USER_TYPE                  = $post['USER_TYPE'];
            $PSE_REFERENCE2             = $post['PSE_REFERENCE2'];
            $PSE_REFERENCE3             = $post['PSE_REFERENCE3'];
        }

        $TX_TAX_RETURN_BASE = $TX_VALUE - $TX_TAX;
        $deviceSessionId    = md5(session_id().microtime());
        $cookie             = session_id();
        $ipAddress          = $this->getRealIP();
        $uri_string         = base_url('Home/pay?course_id='.$post['course_id']);


        #echo $signature;
        #echo $method;
        #exit;

        // Pago por tarjeta
        if( $post['type'] == 1 ){

            #${}
            $curl = curl_init();
            $url  = "https://".$sandbox."api.payulatam.com/payments-api/4.0/service.cgi";
            $CURLOPT_POSTFIELDS = '
            {
               "language": "es",
               "command": "SUBMIT_TRANSACTION",
               "merchant": {
                  "apiKey": "'.$ApiKey.'",
                  "apiLogin": "'.$apiLogin.'"
               },
               "transaction": {
                  "order": {
                     "accountId": "'.$accountId.'",
                     "referenceCode": "'.$referenceCode.'",
                     "description": "Pago por tarjeta",
                     "language": "es",
                     "signature": "'.$signature.'",
                     "notifyUrl": "http://www.payu.com/notify",
                     "additionalValues": {
                        "TX_VALUE": {
                           "value": '.$TX_VALUE.',
                           "currency": "COP"
                     },
                        "TX_TAX": {
                           "value": '.$TX_TAX.',
                           "currency": "COP"
                     },
                        "TX_TAX_RETURN_BASE": {
                           "value": '.$TX_TAX_RETURN_BASE.',
                           "currency": "COP"
                     }
                     },
                     "buyer": {
                        "merchantBuyerId": "1",
                        "fullName": "'.$post['payer-fullName'].'",
                        "emailAddress": "'.$post['payer-emailAddress'].'",
                        "contactPhone": "'.$post['payer-contactPhone'].'",
                        "dniNumber": "'.$post['payer-dniNumber'].'",
                        "shippingAddress": {
                           "street1": "'.$post['payer-street1'].'",
                           "street2": "'.$post['payer-street2'].'",
                           "city": "'.$post['payer-city'].'",
                           "state": "'.$post['payer-state'].'",
                           "country": "CO",
                           "postalCode": "'.$post['payer-postalCode'].'",
                           "phone": "'.$post['payer-phone'].'"
                        }
                     },
                     "shippingAddress": {
                           "street1": "'.$post['payer-street1'].'",
                           "street2": "'.$post['payer-street2'].'",
                           "city": "'.$post['payer-city'].'",
                           "state": "'.$post['payer-state'].'",
                           "country": "CO",
                           "postalCode": "'.$post['payer-postalCode'].'",
                           "phone": "'.$post['payer-phone'].'"
                    }
                  },
                  "payer": {
                     "merchantPayerId": "1",
                     "fullName": "'.$post['payer-fullName'].'",
                     "emailAddress": "'.$post['payer-emailAddress'].'",
                     "contactPhone": "'.$post['payer-contactPhone'].'",
                     "dniNumber": "'.$post['payer-dniNumber'].'",
                     "billingAddress": {
                        "street1": "'.$post['payer-street1'].'",
                        "street2": "'.$post['payer-street2'].'",
                        "city": "'.$post['payer-city'].'",
                        "state": "'.$post['payer-state'].'",
                        "country": "CO",
                        "postalCode": "'.$post['payer-postalCode'].'",
                        "phone": "'.$post['payer-phone'].'"
                     }
                  },
                  "creditCard": {
                     "number": "'.$number.'",
                     "securityCode": "'.$securityCode.'",
                     "expirationDate": "'.$expirationDate.'",
                     "name": "'.$name.'"
                  },
                  "extraParameters": {
                     "INSTALLMENTS_NUMBER": 1
                  },
                  "type": "AUTHORIZATION_AND_CAPTURE",
                  "paymentMethod": "VISA",
                  "paymentCountry": "CO",
                  "deviceSessionId": "'.$deviceSessionId.'",
                  "ipAddress": "'.$ipAddress.'",
                  "cookie": "'.$cookie.'",
                  "userAgent": "Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0",
                  "threeDomainSecure": {
                     "embedded": false,
                     "eci": "01",
                     "cavv": "AOvG5rV058/iAAWhssPUAAADFA==",
                     "xid": "Nmp3VFdWMlEwZ05pWGN3SGo4TDA=",
                     "directoryServerTransactionId": "00000-70000b-5cc9-0000-000000000cb"
                  }
               },
               "test": '.$test.'
            }
            ';

            #echo "<pre>";
            #echo $CURLOPT_POSTFIELDS;
            #exit;

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $CURLOPT_POSTFIELDS,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
                #'Content-Length: length'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            #echo $response;

            $response = json_decode($response);

            #echo "<pre>";
            #print_r($response);
            #echo $response->transactionResponse->state;
            #exit;

            if( $response->transactionResponse->state == 'APPROVED' ){

                // Se registra como matricula el estudiante
                $data_enroll = array(
                    'user_id'    => $post['user_id'],
                    'course_id'  => $post['course_id'],
                    'date_added' => strtotime(date("Y-m-d H:i:s")),
                    'response'   => json_encode($response),
                    'type'       => $post['type']
                );
                $this->Insignias_model->add_course_ids( $data_enroll );

            }else if( $response->transactionResponse->state == 'DECLINED' ){

                redirect($uri_string.'&state=DECLINED');

            }


        // Enviar transacciones con transferencia bancaria (PSE)
        }else if( $post['type'] == 2 ){
            
            $curl = curl_init();
            $url  = "https://".$sandbox."api.payulatam.com/payments-api/4.0/service.cgi";
            $CURLOPT_POSTFIELDS = '{
               "language": "es",
               "command": "SUBMIT_TRANSACTION",
               "merchant": {
                  "apiKey": "'.$ApiKey.'",
                  "apiLogin": "'.$apiLogin.'"
               },
               "transaction": {
                  "order": {
                     "accountId": "'.$accountId.'",
                     "referenceCode": "'.$referenceCode.'",
                     "description": "Pago por transferencia bancaria (PSE)",
                     "language": "es",
                     "signature": "'.$signature.'",
                     "notifyUrl": "http://www.payu.com/notify",
                     "additionalValues": {
                        "TX_VALUE": {
                           "value": '.$TX_VALUE.',
                           "currency": "COP"
                     },
                        "TX_TAX": {
                           "value": '.$TX_TAX.',
                           "currency": "COP"
                     },
                        "TX_TAX_RETURN_BASE": {
                           "value": '.$TX_TAX_RETURN_BASE.',
                           "currency": "COP"
                     }
                     },
                     "buyer": {
                        "merchantBuyerId": "1",
                        "fullName": "'.$post['payer-fullName'].'",
                        "emailAddress": "'.$post['payer-emailAddress'].'",
                        "contactPhone": "'.$post['payer-contactPhone'].'",
                        "dniNumber": "'.$post['payer-dniNumber'].'",
                        "shippingAddress": {
                           "street1": "'.$post['payer-street1'].'",
                           "street2": "'.$post['payer-street2'].'",
                           "city": "'.$post['payer-city'].'",
                           "state": "'.$post['payer-state'].'",
                           "country": "CO",
                           "postalCode": "'.$post['payer-postalCode'].'",
                           "phone": "'.$post['payer-phone'].'"
                        }
                     },
                     "shippingAddress": {
                           "street1": "'.$post['payer-street1'].'",
                           "street2": "'.$post['payer-street2'].'",
                           "city": "'.$post['payer-city'].'",
                           "state": "'.$post['payer-state'].'",
                           "country": "CO",
                           "postalCode": "'.$post['payer-postalCode'].'",
                           "phone": "'.$post['payer-phone'].'"
                    }
                  },
                  "payer": {
                     "merchantPayerId": "1",
                     "fullName": "'.$post['payer-fullName'].'",
                     "emailAddress": "'.$post['payer-emailAddress'].'",
                     "contactPhone": "'.$post['payer-contactPhone'].'",
                     "dniNumber": "'.$post['payer-dniNumber'].'",
                     "billingAddress": {
                        "street1": "'.$post['payer-street1'].'",
                        "street2": "'.$post['payer-street2'].'",
                        "city": "'.$post['payer-city'].'",
                        "state": "'.$post['payer-state'].'",
                        "country": "CO",
                        "postalCode": "'.$post['payer-postalCode'].'",
                        "phone": "'.$post['payer-phone'].'"
                     }
                  },
                  "extraParameters": {
                     "RESPONSE_URL": "http://www.payu.com/response",
                     "PSE_REFERENCE1": "'.$ipAddress.'",
                     "FINANCIAL_INSTITUTION_CODE": "'.$FINANCIAL_INSTITUTION_CODE.'",
                     "USER_TYPE": "'.$USER_TYPE.'",
                     "PSE_REFERENCE2": "'.$PSE_REFERENCE2.'",
                     "PSE_REFERENCE3": "'.$PSE_REFERENCE3.'"
                  },
                  "type": "AUTHORIZATION_AND_CAPTURE",
                  "paymentMethod": "PSE",
                  "paymentCountry": "CO",
                  "deviceSessionId": "'.$deviceSessionId.'",
                  "ipAddress": "'.$ipAddress.'",
                  "cookie": "'.$cookie.'",
                  "userAgent": "Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0"
               },
               "test": '.$test.'
            }
            ';

            #echo "<pre>";
            #echo $CURLOPT_POSTFIELDS;
            #exit;

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $CURLOPT_POSTFIELDS,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
                #'Content-Length: length'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            #echo $response;

            $response = json_decode($response);

            #echo "<pre>";
            #print_r($response);
            $transactionId = $response->transactionResponse->transactionId;
            $BANK_URL = $response->transactionResponse->extraParameters->BANK_URL;

            // Se registra como matricula el estudiante
            $data_enroll = array(
                'user_id'    => $post['user_id'],
                'course_id'  => $post['course_id'],
                'date_added' => strtotime(date("Y-m-d H:i:s")),
                'response'   => NULL,
                'type'       => $post['type'],
                'transactionId'       => $transactionId
            );
            $this->Insignias_model->add_course_ids( $data_enroll );

            redirect($BANK_URL, 'refresh');


        }
        
        redirect(site_url('home/courses'), 'refresh');

    }
    ///////////////////////////////////////////////////////////////////////////
    //                       Formato PDF
    ///////////////////////////////////////////////////////////////////////////

    public function num_str_pad( $document_id ){
        return str_pad($document_id,5,'0',STR_PAD_LEFT);
    }

    // Logro por (Aprobado su primer certificado)
    public function primer_certificado( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('history_logros AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.type', 5);
        $query = $this->db->get();
        return $query->row();
    }

    public function pdf($type){

        // Variables sobre el Id del curso y Id del usuario
        $user_id   = $this->input->get('user_id');
        $course_id = $this->input->get('course_id');

        $primer_certificado = $this->primer_certificado( $user_id, $course_id )->can;

        $v1 = $this->Media_model->verify_lesson( $user_id, $course_id );
        #echo $this->db->last_query();
        $v2 = $this->Media_model->verify_lesson_is_checked( $user_id, $course_id );
        #echo $this->db->last_query();
        $v3 = $this->Media_model->verify_doc_yes( $user_id, $course_id );
        #echo $this->db->last_query();
        $user = $this->user_model->get_user( $user_id )->row();
        #echo $this->db->last_query();
        $course = $this->user_model->get_course( $course_id )->row();
        #echo $this->db->last_query();

        // Generacion de numero de acta segun el orden de creacion del documento
        $document_id = $v3->id;

        $num_str_pad = $this->num_str_pad( $document_id );

        #exit;
        if( $v1->can == $v2->can && $v3->can > 0 ){
            
            // Variables para Acta
            $nombre_estudiante = $user->first_name." ".$user->last_name;
            $numero_acta       = $num_str_pad;
            $fecha_acta        = date('d/m/Y');
            $firma             = "Firma";
            // Variables para Certificado
            $nombre_usuario    = $user->first_name." ".$user->last_name;
            $nombre_curso      = $course->title;

            if( $type == 1 ){
                #$html = get_settings('description_acta');
                $title = "Acta";
                $file  = "acta";
            }else{
                #$html = get_settings('description_certificado');
                $title = "Certificado";
                $file  = "certificado";

                if( $primer_certificado == 0 ){
                    $history_logros['user_id']   = $user_id;
                    $history_logros['course_id'] = $course_id;
                    $history_logros['lesson_id'] = 0;
                    $history_logros['type']      = 5;
                    $this->db->insert('history_logros', $history_logros);
                }

            }

            $this->load->view('frontend/pdf/'.$file, compact('nombre_estudiante','numero_acta','fecha_acta','firma','nombre_usuario','nombre_curso'));
            $html = $this->output->get_output();
                    // Load pdf library
            $this->load->library('pdf');
            $this->dompdf->loadHtml($html);
            $this->dompdf->setPaper('A4');
            #$this->dompdf->setPaper('A4', 'landscape');
            $this->dompdf->render();
            // Output the generated PDF (1 = download and 0 = preview)
            $this->dompdf->stream("$title.pdf", array("Attachment"=> 0));

        }else{
            echo "no";
        }
    }

    // Lista de certificados en la vista Home
    public function certificates(){
        $page_data['page_name']  = "certificates";
        $page_data['page_title'] = "Certificados";
        $user_id                 = $this->session->userdata('user_id');
        $page_data['docs']       = $this->Media_model->list_docs( $user_id );
        #echo $this->db->last_query();
        
        if($this->session->userdata('user_id') !=""){
            $this->load->view('frontend/default/index-landigpage', $page_data);
        }else{
            redirect(site_url('login'), 'refresh');
        }
    }


    // ========= Matricular estudiante de forma gratuita ==========
    public function free_course(){
        $data['user_id']   = $this->session->userdata('user_id');
        $data['course_id'] = $this->input->post("course_id");
        $data['type']      = 3;
        
        if ($this->db->get_where('enroll', $data)->num_rows() > 0) {
        $this->session->set_flashdata('error_message', get_phrase('student_has_already_been_enrolled_to_this_course'));
        }else {

            $this->db->where('user_id =', $data['user_id'] );
            $this->db->where('course_id = ', $data['course_id'] );
            $result = $this->db->get('enroll');

            if ($result->num_rows() > 0) {
                echo '';
            } else {
                $data['date_added'] = strtotime(date('D, d-M-Y'));
                $this->db->insert('enroll', $data);
                $this->session->set_flashdata('flash_message', get_phrase('student_has_been_enrolled_to_that_course'));
            }
        }
        redirect(site_url('home/courses'), 'refresh');
    }

    ///////////////////////////////////////////////////////////////////////////


}
