<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_m extends CI_Model {
 public function tampil(){
       $query = $this->db->get('biodata');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
   public function caribiodata($match) {
        $field = array('nama','alamat','nohp');    
        $this->db->like('concat('.implode(',',$field).')',$match);
        $query = $this->db->get('biodata');
         if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
}
	 public function tambahbiodata($data){
        return $this->db->insert('biodata', $data);
    }
    public function updatebiodata($id,$field){
        $this->db->where('id', $id);
        $this->db->update('biodata', $field);
        if($this->db->affected_rows() >0){
            return true;
        }else{
            return false;
        }
        
    }
    public function deletebiodata($id){
         $this->db->where('id', $id);
        $this->db->delete('biodata');
           if($this->db->affected_rows() >0){
            return true;
        }else{
            return false;
        }
        
    }

	

}

/* End of file crud_m.php */
/* Location: ./application/models/crud_m.php */