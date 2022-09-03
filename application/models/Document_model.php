<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document_model extends CI_Model {

  // constructor
    function __construct()
    {
        parent::__construct();
    }

    public function getData( $table, $id ) {
        
        $this->db->where('id', $id );
        $query = $this->db->get( $table );
        return $query->row();
    }

    public function getDoc($course_id) {
        
        $this->db->where('course_id', $course_id);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('doc');
        return $query->result();
    }

    public function messageText( $data ) {
        return $this->db->insert('message_teacher', $data);
    }

    public function verifyDoc($course_id) {
        
        $this->db->where('yes', 1);
        $this->db->where('course_id', $course_id);
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('doc');
        return $query->row();
    }

    public function getDocTeacher() {
        $this->db->select('b.id,d.title,c.first_name,c.last_name,b.doc,b.yes,b.no, c.id AS user_id, d.id AS course_id, d.category_id, a.user_id AS tutor_id, b.intentos');
        $this->db->join('doc AS b', "a.course_id = b.course_id");
        $this->db->join('users AS c', "b.user_id = c.id");
        $this->db->join('course AS d', "b.course_id = d.id");
        $this->db->where('a.user_id', $this->session->userdata('user_id'));
        $this->db->order_by('a.id' , 'desc');
        return $this->db->get('enroll_teacher_course AS a')->result();
    }

    // Logro por (cargar su primer evaluación)
    public function primer_evaluacion( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('history_logros AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.type', 3);
        $query = $this->db->get();
        return $query->row();
    }

    // Logro por (Aprobado su primer evaluacion)
    public function aprobado_primer_evaluacion( $user_id, $course_id )
    {
        $this->db->select('COUNT(*) AS can');
        $this->db->from('history_logros AS a');
        $this->db->where('a.user_id', $user_id);
        $this->db->where('a.course_id', $course_id);
        $this->db->where('a.type', 4);
        $query = $this->db->get();
        return $query->row();
    }

    public function add( $data ) {

        $this->db->where('user_id =', $data['user_id']);
        $this->db->where('course_id =', $data['course_id']);
        $result = $this->db->get('doc');

        if ($result->num_rows() > 0) {
            $this->db->where('user_id =', $data['user_id']);
            $this->db->where('course_id =', $data['course_id']);
            $this->db->update('doc', array( 'doc' => $data['doc']  ) );
        } else {

            $first_evaluation = $this->primer_evaluacion( $data['user_id'], $data['course_id'] )->can;

            if( $first_evaluation == 0 ){
                $history_logros['user_id']   = $data['user_id'];
                $history_logros['course_id'] = $data['course_id'];
                $history_logros['lesson_id'] = 0;
                $history_logros['type']      = 3;
                $this->db->insert('history_logros', $history_logros);
            }

            $this->db->insert('doc', $data);
        }
    
    }

    public function delete( $id )
    {
        $this->db->where('id', $id);
        return $this->db->delete('people');
    }

    public function emailSend( $to, $message ){
        
        $subject = 'Nugolo Ciencia';
        $headers = array(
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html;charset=UTF-8",
        "From" => "service@nugolociencia.com",
       # "Reply-To" => "mail.nugolociencia.com"
        );
        
        $send = mail( $to, $subject, $message, $headers );
        
        echo ( $send ? 'Enviado..' : 'Fallido...' );
        
    }

    public function is_approved_yes( $data )
    {
        $id  = $data['id'];
        #$yes = $data['yes'];

        $doc = $this->Media_model->get_doc($id);
        
        #echo "QUE PASA ?";
        #exit;

        if( isset($data['yes']) && $data['yes'] == 'true' ){
            #echo "paso 1";
            #exit;
            $update['yes'] = 1;
            $update['no'] = null;
            $this->db->where('id =', $data['id']);
            $this->db->update('doc', $update );

            $first_approved_evaluation = $this->aprobado_primer_evaluacion( $doc->user_id, $doc->course_id )->can;

            if( $first_approved_evaluation == 0 ){
                $history_logros['user_id']   = $doc->user_id;
                $history_logros['course_id'] = $doc->course_id;
                $history_logros['lesson_id'] = 0;
                $history_logros['type']      = 4;
                $this->db->insert('history_logros', $history_logros);
            }

        }else{
            #echo "paso 2";
            #exit;
            // Se realiza el conteo de los intentos
            $this->db->select('SUM(a.intentos) AS intentos');
            $this->db->from('doc AS a');
            $this->db->where('a.id', $id);
            $docs = $this->db->get();
            $row = $docs->row();
            $intentos = $row->intentos;

            // Se toma el correo del estudiante
            $getUsers = $this->getData( 'users', $doc->user_id );

            $update['no'] = 1;
            $update['intentos'] = $intentos + 1;
            $update['yes'] = null;
            
            $this->db->where('id =', $data['id']);
            $this->db->update('doc', $update );
            
            #echo $intentos;
            #exit;
            #print_r($getUsers->email);
            #exit;

            // Se envia el correo
            if( $update['intentos']  == 2 ){
                #echo "2 intentos"; exit;
                $messageStudentTwo = "Hola viajero ten cuidado porque tu nave puede dañarse, recuerda repasar bien los conceptos vistos en los videos. En los proximos días un Tutor te contactara para orientarte asi que revisa constantemente tus mensajes en plataforma y tu correo electronico.";
                $this->emailSend( $getUsers->email, $messageStudentTwo );
            }else if( $update['intentos'] == 4 ){
                #echo "4 intentos"; exit;
                $messageStudentFor = "Tu nave esta averiada te asignaremos una reunion con un tutor lo mas pronto para que el pueda guiarte en el proceso.";
                $this->emailSend( $getUsers->email, $messageStudentFor );
            }

        }

    }

}
