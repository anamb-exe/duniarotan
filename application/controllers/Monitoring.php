<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata['logged'] == TRUE)
        { }
            
        else
        {
            $this->session->set_flashdata('message', '<div style="color : red;">Login Terlebih Dahulu</div>');
            redirect('Login');
        }

        $this->load->model('M_monitoring');
        $this->load->model('M_dataorder');
        $this->load->helper(array('form', 'url','tombol','add'));
        // $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    }

    public function index(){
        $this->load->view('dist/admin/v_monitoring', array(
            'title' => "Monitoring",
            'order' => $this->M_dataorder->getSemua()->result()));
    }


public function setView(){
        $result = $this->M_monitoring->getSemua()->result();
        $list   = array();
        $No     = 1;
        foreach ($result as $r) {
            $row    = array(
                        "no"             => $No,
                        "kode"      => $r->kode,
                        "foto"      => $r->foto,
                        "tanggal"      => $r->tanggal,
                        "keterangan"      => $r->keterangan,
                        "order"      => $r->order,
                        "action"         => tombol($r->id)
            );

            $list[] = $row;
            $No++;
        }   
        echo json_encode(array('data' => $list));
    }

    public function ajax_delete($id)
    {
        $this->M_monitoring->delete_by_kode($id);
        echo json_encode(array("status" => TRUE));
    }


    function ajax_add(){

        date_default_timezone_get('Asia/Jakarta');
        $now = date('Y-m-d');

        $kode = $this->input->post('kode'); 
        $tanggal    = $this->input->post('tanggal');
        $keterangan = $this->input->post('keterangan');
        $order      = $this->input->post('order');
        
        $data = array(
            "kode"      => $this->input->post('kode'),
            "tanggal"      => $now,
            "foto"      => "img",
            "keterangan"      => $this->input->post('keterangan'),
            "order"      => $this->input->post('order')
            );

        //add img begin
        // if(!empty($_FILES['photo']['name'])) //ambil variabel 'photo' dari veiw
        //     {
        //         $upload = $this->_do_upload();
        //         $data['foto'] = $upload; //Img diambil dari field database
        //     } else {
        //         $data['foto'] = "default.jpg";
        //     }
        //add img end

        $this->M_monitoring->inputdata($data,'monitoring');
        echo json_encode(array("status" => TRUE));  
     
           
    }
    
       public function ajax_edit($id)
    {
        $data = $this->M_monitoring->edit($id);
        echo json_encode($data);
    }

    function ajax_update(){
        $id = $this->input->post('id');
        $kode = $this->input->post('kode');
        $tanggal = $this->input->post('tanggal');
        $keterangan = $this->input->post('keterangan');
        $order = $this->input->post('order');
        
        
        $data = array(
            "kode"      => $kode,
            "tanggal"       => $tanggal,
            "keterangan"       => $keterangan,
            "order"       => $order,

        );

        $where = array(
        'id' => $id
    );
 
        $this->M_monitoring->update($where,$data);
        echo json_encode(array("status" => TRUE));
    }

    //load library upload
    function _do_upload(){
        $config['upload_path']   = './assets/temp/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name']  = TRUE; //Enkripsi nama yang terupload
 
        $this->upload->initialize($config);
        if(!empty($_FILES['photo']['name'])){
 
            if ($this->upload->do_upload('photo')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./assets/temp/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '100%';
                $config['width']= 400;
                $config['height']= 400;
                $config['new_image']= './assets/monitoring/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
 
                $gambar=$gbr['file_name'];
                return $gambar;
            }
                      
        }else{
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
                 
    }
}
