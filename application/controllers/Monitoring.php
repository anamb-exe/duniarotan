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
        $this->load->helper(array('form', 'url','tombol','add','img','see'));
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
                        "foto"      => img($r->foto),
                        "tanggal"      => $r->tanggal,
                        "keterangan"      => $r->keterangan,
                        "order"      => $r->nama,
                        "action"         => see($r->id)
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

        /* date_default_timezone_get('Asia/Jakarta');*/
        $now = date('Y-m-d'); 

        $kode = $this->input->post('kode'); 
        
        $data = array(
            "kode"      => $this->input->post('kode'),
            "tanggal"      => $now,
            "keterangan"      => $this->input->post('keterangan'),
            "order"      => $this->input->post('order')
            );

        //add img begin
        if(!empty($_FILES['photo']['name'])) //ambil variabel 'photo' dari veiw
            {
                $upload = $this->_do_upload();
                $data['foto'] = $upload; //Img diambil dari field database
            } else {
                 $data['foto'] = "default.jpg";
             }
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
            "keterangan"       => $keterangan,
            "order"       => $order,

        );
        
        //add img begin
        if(!empty($_FILES['photo']['name'])) //ambil variabel 'photo' dari veiw
            {
                $upload = $this->_do_upload();
                $data['foto'] = $upload; //Img diambil dari field database
            } else {
                 
             }
        //add img end

        $where = array(
        'id' => $id
    );
 
        $this->M_monitoring->update($where,$data);
        echo json_encode(array("status" => TRUE));
    }

    //load library upload
    private function _do_upload()
    {
        $config['upload_path']          = './assets/foto/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 7000; //set max size allowed in Kilobyte
        $config['max_width']            = 3000; // set max width image allowed
        $config['max_height']           = 3000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
 
        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    } 
}
