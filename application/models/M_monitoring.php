<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_monitoring extends CI_Model{

    function __construct() {
        parent::__construct();
        
        $this->load->model('DbHelper');
    }
    function getSemua(){
        $this->db->select('monitoring.*');
        $this->db->select('order.nama');
        $this->db->from('monitoring');
        $this->db->join('order', 'order.kode=monitoring.order','left');
        $query = $this->db->get();
        return $query; 

    }

    function cek_meja($table,$where){

        return $this->db->get_where($table,$where);
    
      }

    function hapus_data($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    function inputdata($data2,$table){
        $this->db->insert($table,$data2);
    }

    public function edit($id)
    {
        $this->db->select('*');
        $this->db->from('monitoring');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

     public function delete_by_kode($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('monitoring');
    }  
     public function update($where, $data)
    {
        $this->db->update('monitoring', $data, $where);
    }
 

}
