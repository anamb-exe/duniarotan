<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataorder extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata['logged'] == TRUE)
        { }
            
        else
        {
            $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
            redirect('Login');
        }

        $this->load->model('M_dataorder');
        $this->load->helper(array('form', 'url','tombol','add'));
        // $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    }

    public function index(){
         $data = array(
            'title' => "Dataorder"
        );
        $this->load->view('dist/admin/v_dataorder', $data);
    }


public function setView(){
        $result = $this->M_dataorder->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"             => $No,
                        "kode"      => $r->kode,
                        "nama"      => $r->nama,
                        "tanggal"      => $r->tanggal,
                        "keterangan"      => $r->keterangan,
                        "action"         => tombol($r->ID)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

     public function ajax_delete($id)
    {
        $this->M_dataorder->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }



    function ajax_add(){


        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama'); 
        $tanggal = $this->input->post('tanggal');
        $keterangan = $this->input->post('keterangan');
        
        $data = array(
            
            "kode"      => $kode,
            "nama"      => $nama,
            "tanggal"       => $tanggal,
            "keterangan"      => $r->keterangan,
            
            );

        $this->M_dataorder->inputdata($data,'order');
        echo json_encode(array("status" => TRUE));  
     
           
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_dataorder->edit($id)->result();
        echo json_encode($data);
    }

    function ajax_update(){
        $id = $this->input->post('id');
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama'); 
        $tanggal = $this->input->post('tanggal');
        $keterangan = $this->input->post('keterangan');
        
        
        $data = array(
            "kode"      => $kode,
            "nama"      => $nama,
            "tanggal"       => $tanggal,
            "keterangan"       => $keterangan,

        );

        $where = array(
        'id' => $id
    );
 
        $this->M_dataorder->update($where,$data);
        echo json_encode(array("status" => TRUE));

}
}
