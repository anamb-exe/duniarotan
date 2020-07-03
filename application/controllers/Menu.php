<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata['logged'] == TRUE)
        { }
            
        else
        {
            $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
            redirect('Login');
        }

        $this->load->model('M_menu');
        $this->load->helper(array('form', 'url','tombol','img'));
    }

    public function index(){
         $data = array(
            'title' => "Menu"
        );
        $this->load->view('dist/admin/v_menu', $data);
    }

public function setView(){
        $result = $this->M_menu->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"             => $No,
                        "id"             => $r->id_menu,
                        "kode_menu"      => $r->kode_menu,
                        "nama_menu"      => $r->nama_menu,
                        "harga_menu"     => $r->harga_menu,
                        "gambar"         => img($r->gambar),
                        "aktif"          => $r->aktif,
                        "action"         => tombol($r->id_menu)
            );

            $list[] = $row;
            $No++;
        }   

        echo json_encode(array('data' => $list));
    }

     public function ajax_delete($id)
    {
        $person = $this->M_menu->edit($id);
        if(file_exists('./assets/imgmenu/'.$person->gambar) && $person->gambar)
            unlink('./assets/imgmenu/'.$person->gambar);


        $this->M_menu->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }

    
    
       public function ajax_edit($id)
    {
        $data = $this->M_menu->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        $id = $this->input->post('id');
        $kode_menu = $this->input->post('kode');
        $nama_menu = $this->input->post('nama');
        $harga_menu = $this->input->post('harga');
        $gambar = $this->input->post('gambar');
        $aktif = $this->input->post('aktif');

    $data = array(  
         "kode_menu"      => $kode_menu,
         "nama_menu"      => $nama_menu,
         "harga_menu"     => $harga_menu,
        // "gambar"         => $r->gambar,  //perlu coding update gambar
         "aktif"          => $aktif,
            );

        $where = array(
        'id_menu' => $id
    );


        if($this->input->post('remove_photo')) // if remove gambar checked
        {
            if(file_exists('./assets/imgmenu/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                unlink('./assets/imgmenu/'.$this->input->post('remove_photo'));
            $data['gambar'] = '';
        }
 
        if(!empty($_FILES['gambar']['name']))
        {
            $assets = $this->_do_upload();
             
            //delete file
            $person = $this->M_menu->edit($this->input->post('id'));
            if(file_exists('/assets/imgmenu/'.$person->gambar) && $person->gambar)
                unlink('/assets/imgmenu/'.$person->gambar);
 
            $data['gambar'] = $assets;
        }
 
        $this->M_menu->update($where,$data);
        echo json_encode(array("status" => TRUE));

}

function ajax_add(){

        $kode_menu  = $this->input->post('kode');
        $nama_menu  = $this->input->post('nama');
        $harga_menu = $this->input->post('harga');
        $aktif      = $this->input->post('aktif');
 
        $data = array(
            "kode_menu"      => $kode_menu,
            "nama_menu"      => $nama_menu,
            "harga_menu"     => $harga_menu,
            "aktif"          => $aktif,
            
            );

        if(!empty($_FILES['gambar']['name']))
        {
            $upload = $this->_do_upload();
            $data['gambar'] = $upload;
        }

        $this->M_menu->inputdata($data,'menu');
        echo json_encode(array("status" => TRUE));    
           
    }

 private function _do_upload()
    {
        $config['upload_path']          = './assets/imgmenu/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('gambar')) //upload and validate
        {
            $data['inputerror'][] = 'gambar';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

}
