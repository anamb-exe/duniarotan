<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bahanbaku extends CI_Model{

    function __construct() {
        parent::__construct();
        
        $this->load->model('DbHelper');
    }
    function getSemua(){
        $sql    =   "SELECT * from bahanbaku";
                    
        return $this-> DbHelper->execQuery($sql);

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
     $query = $this->db->query("SELECT * from bahanbaku where bahanbaku.id='$id'");
    return $query->row(); 
    }

     public function delete_by_kode($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('bahanbaku');
    }  
     public function update($where, $data)
    {
        $this->db->update('bahanbaku', $data, $where);
    }
 

}
