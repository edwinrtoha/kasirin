<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trx_crud_model_api extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_model');
    }
    public function show($param=""){
        $query=$this->Trx_model->trx($param);
        // if($query->num_rows()>0){
        return $query->result();
        // }
        // else{
            // return false;
        // }
    }
    public function delete($param=""){
        $this->Trx_model->trx_del($param);
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }
}

/* End of file crud_m.php */
/* Location: ./application/models/crud_m.php */