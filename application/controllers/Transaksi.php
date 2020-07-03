<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata['logged'] == TRUE)
        { }
            
        else
        {
            $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
            redirect('Login');
        }

        $this->load->model('M_transaksi');
        $this->load->helper(array('form', 'url','tombol','img'));
    }

    public function index(){
         $data = array(
            'title' => "Transaksi"
        );
        $this->load->view('dist/admin/v_transaksi', $data);
    }

public function setView(){
        $result = $this->M_transaksi->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"             => $No,
                        "id"             => $r->id_transaksi,
                        "total"          => $r->total,
                        "nama_pemesan"   => $r->nama_pemesan,
                        "refdetail"      => $r->refdetail,
                        "meja"           => $r->meja,
                        "waktu_pemesan"  => $r->waktu_pemesanan,
                        "action"         => tombol($r->id_transaksi)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

     public function ajax_delete($id)
    {
        
        $this->M_transaksi->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

    
    
       public function ajax_edit($id)
    {
        $data = $this->M_transaksi->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        $id = $this->input->post('id');
        $total = $this->input->post('total');
        $nama_pemesan = $this->input->post('nama_pemesan');
        $refdetail = $this->input->post('refdetail');
        $meja = $this->input->post('meja');
        $waktu_pemesanan = $this->input->post('waktu_pemesanan');


    $data = array(  
                        "total"          => $r->total,
                        "nama_pemesan"   => $r->nama_pemesan,
                        "refdetail"      => $r->refdetail,
                        "meja"           => $r->meja,
                        "waktu_pemesan"  => $r->waktu_pemesanan,
            );

        $where = array(
        'id_transaksi' => $id
    );

 
        $this->M_transaksi->update($where,$data);
        echo json_encode(array("status" => TRUE));

}

function ajax_add(){

        $id = $this->input->post('id');
        $total = $this->input->post('total');
        $nama_pemesan = $this->input->post('nama_pemesan');
        $refdetail = $this->input->post('refdetail');
        $meja = $this->input->post('meja');
        $waktu_pemesanan = $this->input->post('waktu_pemesanan');
        
 
        $data = array(
            "total"          => $r->total,
            "nama_pemesan"   => $r->nama_pemesan,
            "refdetail"      => $r->refdetail,
            "meja"           => $r->meja,
            "waktu_pemesan"  => $r->waktu_pemesanan,
            

            
            );

       

        $this->M_transaksis->inputdata($data,'transaksi');
        echo json_encode(array("status" => TRUE));    
           
    }


}
