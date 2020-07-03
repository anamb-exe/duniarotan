<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata['logged'] == TRUE)
        { }
            
        else
        {
            $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
            redirect('Login');
        }

        $this->load->model('M_user');
        $this->load->helper(array('form', 'url','tombol','img'));
    }

    public function index(){
         $data = array(
            'title' => "User"
        );
        $this->load->view('dist/admin/v_user', $data);
    }

public function setView(){
        $result = $this->M_user->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"             => $No,
                        "id"             => $r->id_login,
                        "username"      => $r->username,
                        "password"      => $r->password,
                        "action"         => tombol($r->id_login)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

     public function ajax_delete($id)
    {
        
        $this->M_user->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

    
    
       public function ajax_edit($id)
    {
        $data = $this->M_user->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');


    $data = array(  
         "username"      => $username,
         "password"      => $password,
            );

        $where = array(
        'id_login' => $id
    );

 
        $this->M_user->update($where,$data);
        echo json_encode(array("status" => TRUE));

}

function ajax_add(){

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
 
        $data = array(
            "username"      => $username,
            "password"      => $password,

            
            );

       

        $this->M_user->inputdata($data,'user');
        echo json_encode(array("status" => TRUE));    
           
    }


}
