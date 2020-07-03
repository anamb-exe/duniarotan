<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scanqr extends CI_Controller {

    function __construct() {
        parent::__construct();
        // if ($this->session->userdata['logged'] == TRUE)
        // { }
            
        // else
        // {
        //     $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
        //     redirect('Login');
        // }

        $this->load->model('M_meja');
        $this->load->helper(array('form', 'url','tombol','img'));
    }

    public function index(){
         $data = array(
            'title' => "Scan-QR Begin"
        );
        $this->load->view('dist/user/v_scanqr', $data);
    }

    public function success(){
        $data = array(
           'title' => "Scan-QR Done"
       );
       $this->load->view('dist/user/v_success', $data);
   }

function aksi_scan(){
        $nama       = $this->input->post('nama');
        $decodeqr   = $this->input->post('decodeqr');
        $where      = array(
            'kode_meja' => $decodeqr,
            );
        $cek = $this->M_meja->cek_meja("meja",$where)->num_rows();
        if($cek > 0){
           $query = $this->db->query("SELECT
                                    meja.kode_meja,
                                    meja.no_meja
                                    FROM meja where meja.kode_meja='$decodeqr'
                                    ");
            $row = $query->row();
            $data_session = array(
                'nama'          => $nama,
                'logged_user'   => TRUE,
                
            );

            $this->session->set_userdata($data_session);

            $this->session->set_flashdata('message', '<div  class="col-md-3 alrt-success alert-dismissible" data-dismiss="alert" aria-hidden="true" >
                <i class="icon fa fa-check"></i>
                Login Sukses
              </div>');
                redirect('Scanqr/success');

        }else{
            $this->session->set_flashdata('message', '<div style="color : red;">Qr-Code tidak valid !</div>');
            redirect('Scanqr');
        }
    }
    
    function logout(){
        $this->session->unset_userdata('logged');
        redirect(base_url('login'));
    }

}
