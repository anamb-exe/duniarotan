<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahanbaku extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata['logged'] == TRUE)
        { }
            
        else
        {
            $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
            redirect('Login');
        }

        $this->load->model('M_bahanbaku');
        $this->load->helper(array('form', 'url','tombol','add'));
        // $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    }

    public function index(){
         $data = array(
            'title' => "Bahanbaku"
        );
        $this->load->view('dist/admin/v_bahanbaku', $data);
    }


public function setView(){
        $result = $this->M_bahanbaku->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"             => $No,
                        "id"      => $r->id,
                        "kode"      => $r->kode,
                        "tgl_masuk"      => $r->tgl_masuk,
                        "jumlah"      => add($r->jumlah),
                        "action"         => tombol($r->id)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

     public function ajax_delete($id)
    {
        $this->M_bahanbaku->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }



    function ajax_add(){


        $kode = $this->input->post('kode');
        $tgl_masuk = $this->input->post('tgl_masuk'); 
        $jumlah = $this->input->post('jumlah');
        
        $data = array(
            "kode"      => $kode,
            "tgl_masuk"      => $tgl_masuk,
            "jumlah"       => $jumlah
            
            );

        $this->M_bahanbaku->inputdata($data,'bahanbaku');
        echo json_encode(array("status" => TRUE));  
     
           
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_bahanbaku->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        $id = $this->input->post('id');
       $kode = $this->input->post('kode');
       $tgl_masuk = $this->input->post('tgl_masuk'); 
        $jumlah = $this->input->post('jumlah');
        
        $data = array(
            "kode"      => $kode,
            "tgl_masuk"      => $tgl_masuk,
            "jumlah"       => $jumlah
        );

        $where = array(
        'id' => $id
    );
 
        $this->M_bahanbaku->update($where,$data);
        echo json_encode(array("status" => TRUE));

}
}
