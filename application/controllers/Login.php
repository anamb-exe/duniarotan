<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        // if ($this->session->userdata['logged'] == TRUE)
        // { }
            
        // else
        // {
        //     $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
        //     redirect('Login');
        // }

        $this->load->model('M_login');
        $this->load->helper(array('form', 'url','tombol','img'));
    }

    public function index(){
         $data = array(
            'title' => "Login"
        );
        $this->load->view('v_login', $data);
    }

function aksi_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $where = array(
            'username' => $username,
            'password' => $password,

            );
        $cek = $this->M_login->cek_login("login",$where)->num_rows();
        if($cek > 0){
           $query = $this->db->query("SELECT
                                    login.username,
                                    login.password
                                    FROM login where username='$username'
                                    ");
            $row = $query->row();
            $data_session = array(
                'username' => $username,
                'logged'    => TRUE,
                
            );

            $this->session->set_userdata($data_session);

            $this->session->set_flashdata('message', '<div  class="col-md-3 alrt-success alert-dismissible" data-dismiss="alert" aria-hidden="true" >
                <i class="icon fa fa-check"></i>
                Login Sukses
              </div>');
                redirect('Bahanbaku');

        }else{
            $this->session->set_flashdata('message', '<div style="color : red;">Username dan password Tidak Ditemukan</div>');
            redirect('login');
        }
    }
    
    function logout(){
        $this->session->unset_userdata('logged');
        redirect(base_url('login'));
    }

}
