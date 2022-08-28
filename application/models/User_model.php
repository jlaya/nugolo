<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function messageCountUser() {
        $this->db->select('COUNT(a.message_thread_id) AS can');
        $this->db->where('b.read_status', NULL);
        $this->db->join('message AS b', "a.sender = b.sender");
        $this->db->where('a.reciever', $this->session->userdata('user_id'));
        $query = $this->db->get('message_thread AS a');
        return $query->row();
    }

    public function message_teacher() {
        $this->db->select('COUNT(a.id) AS can');
        $this->db->where('a.visto', NULL);
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('message_teacher AS a');
        return $query->row();
    }

    public function updateMessageUserTeacher() {

        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $this->db->where('a.visto', NULL);
        $this->db->update('message_teacher AS a', array( 'a.visto' => 1 ) );
    }

    public function updateMessageUser( $message_thread_code ) {

        $this->db->where('a.message_thread_code', $message_thread_code );
        $this->db->where('a.read_status', NULL );
        $this->db->update('message AS a', array( 'a.read_status' => 1 ) );
    }

    public function messageTextUser() {
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $this->db->where('a.visto', NULL );
        $query = $this->db->get('message_teacher AS a');
        return $query->result();
    }

    /**
    / Departamentos
    */
    public function get_depart() {
        return $this->db->get('depart')->result();
    }

    public function getCategory() {
        $this->db->where('a.parent', 0);
        return $this->db->get('category AS a')->result();
    }

    /**
    / Paises
    */
    public function get_countries() {
        $this->db->order_by('name', 'ASC');
        $obj = $this->db->get('countries');
        return $obj->result();
    }

    /**
    / Ciudades segun la provincia
    */
    public function provincia_ciudad($cod) {
        $this->db->where('a.depart', $cod);
        return $this->db->get('city AS a')->result();
    }

    /**
    / Tareas asignadas
    */
    public function get_homework_items( $user_id ) {

        $this->db->select('a.id, b.name, b.url,b.color, a.is_checked ');
        $this->db->join('homework AS b', "b.id = a.join_id");
        $this->db->where('a.user_id', $user_id);
        return $this->db->get('people AS a')->result();
    }

    /**
    / Catgoria/Sub-categoria GyM
    */
    public function get_category() {
        return $this->db->get('category_gym')->result();
    }

    /**
    / Ajax Sub-category
    */
    public function ajax_sub_category( $id ) {
        $this->db->where( 'category_id' , $id );
        return $this->db->get('sub_category_gym')->result();
    }

    public function get_admin_details() {
        return $this->db->get_where('users', array('role_id' => 1));
    }

    public function get_user($user_id = 0, $rol=2) {

        if ($user_id > 0) {
            $this->db->where('id', $user_id);
        }
        $this->db->where('role_id', $rol);
        return $this->db->get('users');
    }

    public function get_rutinas() {
        $this->db->where('status', 'active');
        return $this->db->get('course');
    }

    public function get_course( $course_id ) {
        $this->db->where('id', $course_id);
        return $this->db->get('course');
    }

    public function show_users_rutinas($course_id) {
        $this->db->select(' b.id , b.first_name , b.last_name ');
        $this->db->join('users AS b', "a.user_id = b.id");
        $this->db->where('a.course_id', $course_id);
        return $this->db->get('enroll AS a');
    }

    public function update_client( $client_id , $ref_payco ) {

        $this->db->where('user_id', $client_id );
        $this->db->update('users_detail', array( 'ref_payco' => $ref_payco ) );

    }

    public function get_all_user($user_id = 0) {
        if ($user_id > 0) {
            $this->db->where('id', $user_id);
        }
        return $this->db->get('users');
    }

    public function get_all_user_in($user_id = null) {
        
        
            $this->db->where_in('id', $user_id);
        
        return $this->db->get('users');
    }

    public function get_all_user_in_list($role_id = array(3,4,5,6) ) {
        /*$this->db->where_in('role_id', $role_id);
        $this->db->order_by('role_id', 'ASC');
        return $this->db->get('users')->result_array();*/
        $this->db->select('a.*,b.name AS role');
        $this->db->join('role AS b', "a.role_id = b.id");
        $this->db->where_in('a.role_id', $role_id);
        $this->db->order_by('a.role_id', 'ASC');
        return $this->db->get('users AS a')->result_array();
    }

    public function add_user($role_id=2) {
        $validity = $this->check_duplication('on_create', $this->input->post('email'));
        if ($validity == false) {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        }else {
            $data['first_name'] = html_escape($this->input->post('first_name'));
            $data['last_name'] = html_escape($this->input->post('last_name'));
            $data['email'] = html_escape($this->input->post('email'));
            $data['password'] = sha1(html_escape($this->input->post('password')));
            $social_link['facebook'] = html_escape($this->input->post('facebook_link'));
            $social_link['twitter'] = html_escape($this->input->post('twitter_link'));
            $social_link['linkedin'] = html_escape($this->input->post('linkedin_link'));
            $data['social_links'] = json_encode($social_link);
            $data['biography'] = $this->input->post('biography');
            $data['role_id'] = $role_id;
            $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
            $data['wishlist'] = json_encode(array());
            $data['watch_history'] = json_encode(array());
            $data['status'] = 1;
            // Add paypal keys
            $paypal_info = array();
            $paypal['production_client_id'] = html_escape($this->input->post('paypal_client_id'));
            array_push($paypal_info, $paypal);
            $data['paypal_keys'] = json_encode($paypal_info);
            // Add Stripe keys
            $stripe_info = array();
            $stripe_keys = array(
                'public_live_key' => html_escape($this->input->post('stripe_public_key')),
                'secret_live_key' => html_escape($this->input->post('stripe_secret_key'))
            );
            array_push($stripe_info, $stripe_keys);
            $data['stripe_keys'] = json_encode($stripe_info);

            $this->db->insert('users', $data);
            $user_id = $this->db->insert_id();
            $this->upload_user_image($user_id);
            $this->session->set_flashdata('flash_message', get_phrase('user_added_successfully'));
        }
    }

    public function check_duplication($action = "", $email = "", $user_id = "") {
        $duplicate_email_check = $this->db->get_where('users', array('email' => $email));

        if ($action == 'on_create') {
            if ($duplicate_email_check->num_rows() > 0) {
                return false;
            }else {
                return true;
            }
        }elseif ($action == 'on_update') {
            if ($duplicate_email_check->num_rows() > 0) {
                if ($duplicate_email_check->row()->id == $user_id) {
                    return true;
                }else {
                    return false;
                }
            }else {
                return true;
            }
        }
    }

    public function edit_user($user_id = "") { // Admin does this editing
        $validity = $this->check_duplication('on_update', $this->input->post('email'), $user_id);
        if ($validity) {
            $data['first_name'] = html_escape($this->input->post('first_name'));
            $data['last_name'] = html_escape($this->input->post('last_name'));

            if (isset($_POST['email'])) {
                $data['email'] = html_escape($this->input->post('email'));
            }
            if ($_POST['password'] !="") {
                $data['password']  = sha1($this->input->post('password'));
            }
            $social_link['facebook'] = html_escape($this->input->post('facebook_link'));
            $social_link['twitter'] = html_escape($this->input->post('twitter_link'));
            $social_link['linkedin'] = html_escape($this->input->post('linkedin_link'));
            $data['social_links'] = json_encode($social_link);
            $data['biography'] = $this->input->post('biography');
            $data['title'] = html_escape($this->input->post('title'));
            $data['last_modified'] = strtotime(date("Y-m-d H:i:s"));

            // Update paypal keys
            $paypal_info = array();
            $paypal['production_client_id'] = html_escape($this->input->post('paypal_client_id'));
            array_push($paypal_info, $paypal);
            $data['paypal_keys'] = json_encode($paypal_info);
            // Update Stripe keys
            $stripe_info = array();
            $stripe_keys = array(
                'public_live_key' => html_escape($this->input->post('stripe_public_key')),
                'secret_live_key' => html_escape($this->input->post('stripe_secret_key'))
            );
            array_push($stripe_info, $stripe_keys);
            $data['stripe_keys'] = json_encode($stripe_info);

            $this->db->where('id', $user_id);
            $this->db->update('users', $data);
            $this->upload_user_image($user_id);
            $this->session->set_flashdata('flash_message', get_phrase('user_update_successfully'));
        }else {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        }

        $this->upload_user_image($user_id);
    }
    public function delete_user($user_id = "") {
        $this->db->where('id', $user_id);
        $this->db->delete('users');
        $this->session->set_flashdata('flash_message', get_phrase('user_deleted_successfully'));
    }

    public function unlock_screen_by_password($password = "") {
        $password = sha1($password);
        return $this->db->get_where('users', array('id' => $this->session->userdata('user_id'), 'password' => $password))->num_rows();
    }

    public function register_user($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function register_user_detail($data) {
        $this->db->insert('users_detail', $data);
        return $this->db->insert_id();
    }

    public function detail_user_detail() {
        $this->db->select('*');
        $this->db->where('a.role_id', 2 );
        return $this->db->get('users AS a')->result();
    }

    // Asociacion Curso con Profesor
    public function enroll_teacher_course() {
        $this->db->select('*');
        $this->db->where('a.role_id', 3 );
        $this->db->order_by('a.id', 'ASC' );
        return $this->db->get('users AS a')->result();
    }

    public function my_courses() {
        //return $this->db->get_where('enroll', array('user_id' => $this->session->userdata('user_id')));
        //return $this->db->get('course');
        $this->db->select('*');
        $this->db->join('enroll AS b', "b.course_id = a.id");
        $this->db->where('a.status', 'active' );
        $this->db->where('b.user_id', $this->session->userdata('user_id') );
        return $this->db->get('course AS a')->result_array();
    }

    public function upload_user_image($user_id) {
        if (isset($_FILES['user_image']) && $_FILES['user_image']['name'] != "") {
            move_uploaded_file($_FILES['user_image']['tmp_name'], 'uploads/user_image/'.$user_id.'.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('user_update_successfully'));
        }
    }

    public function update_account_settings($user_id) {
        $validity = $this->check_duplication('on_update', $this->input->post('email'), $user_id);
        if ($validity) {
            if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
                $user_details = $this->get_user($user_id)->row_array();
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password');
                $confirm_password = $this->input->post('confirm_password');
                if ($user_details['password'] == sha1($current_password) && $new_password == $confirm_password) {
                    $data['password'] = sha1($new_password);
                }else {
                    $this->session->set_flashdata('error_message', get_phrase('mismatch_password'));
                    return;
                }
            }
            $data['email'] = html_escape($this->input->post('email'));
            $this->db->where('id', $user_id);
            $this->db->update('users', $data);
            $this->session->set_flashdata('flash_message', get_phrase('updated_successfully'));
        }else {
            $this->session->set_flashdata('error_message', get_phrase('email_duplication'));
        }
    }

    public function change_password($user_id) {
        $data = array();
        if (!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            $user_details = $this->get_all_user($user_id)->row_array();
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');

            if ($user_details['password'] == sha1($current_password) && $new_password == $confirm_password) {
                $data['password'] = sha1($new_password);
            }else {
                $this->session->set_flashdata('error_message', get_phrase('mismatch_password'));
                return;
            }
        }

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
        $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
    }


    public function get_instructor($id = 0) {
        if ($id > 0) {
            return $this->db->get_all_user($id);
        }else {
            if ($this->check_if_instructor_exists()) {
                $this->db->select('user_id');
                $this->db->distinct('user_id');
                $query_result =  $this->db->get('course');
                $ids = array();
                foreach ($query_result->result_array() as $query) {
                    if ($query['user_id']) {
                        array_push($ids, $query['user_id']);
                    }
                }

                $this->db->where_in('id', $ids);
                return $this->db->get('users')->result_array();
            }
            else {
                return array();
            }
        }
    }

    public function check_if_instructor_exists() {
        $this->db->where('user_id >', 0);
        $result = $this->db->get('course')->num_rows();
        if ($result > 0) {
            return true;
        }else {
            return false;
        }
    }

    public function get_user_image_url($user_id) {

         if (file_exists('uploads/user_image/'.$user_id.'.jpg'))
             return base_url().'uploads/user_image/'.$user_id.'.jpg';
        else
            return base_url().'uploads/user_image/placeholder.png';
    }
    public function get_instructor_list() {
        //$query1 = $this->db->get_where('course', array('status' => 'active'))->result_array();
        //$instructor_ids = array();
        //foreach ($query1 as $row1) {
        //    if (!in_array($row1['user_id'], $instructor_ids) && $row1['user_id'] != "") {
        //        array_push($instructor_ids, $row1['user_id']);
        //    }
        //}
        $this->db->where_not_in('role_id', 2);
        $query_result = $this->db->get('users');
        return $query_result;
    }

    public function update_instructor_payment_settings($user_id = '') {
        // Update paypal keys
        $paypal_info = array();
        $paypal['production_client_id'] = html_escape($this->input->post('paypal_client_id'));
        array_push($paypal_info, $paypal);
        $data['paypal_keys'] = json_encode($paypal_info);
        // Update Stripe keys
        $stripe_info = array();
        $stripe_keys = array(
            'public_live_key' => html_escape($this->input->post('stripe_public_key')),
            'secret_live_key' => html_escape($this->input->post('stripe_secret_key'))
        );
        array_push($stripe_info, $stripe_keys);
        $data['stripe_keys'] = json_encode($stripe_info);
        // Update bank info
        $bank_info = array();
        $bank_information = array(
            'BankName' => html_escape($this->input->post('BankName')),
            'TypeAccount' => html_escape($this->input->post('TypeAccount')),
            'AccountName' => html_escape($this->input->post('AccountName')),
            'BankAccept' => html_escape($this->input->post('BankAccept'))
        );
        array_push($bank_info, $bank_information);
        $data['bank_information'] = json_encode($bank_info);

        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }
}
