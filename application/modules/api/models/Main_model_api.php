<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model_api extends CI_Model {
    public function array_in_param($datas){
        $datas=explode(",",$datas);
        for ($i=0; $i < sizeof($datas); $i++) { 
            $temp_data=explode("=", $datas[$i]);
            $data[$temp_data[0]]=$temp_data[1];
        }
        return $data;
    }
}

/* End of file crud_m.php */
/* Location: ./application/models/crud_m.php */