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

    public function string_to_array($raw,$ignore_null=0){
        // $raw = data11,data12,data13;data21,data22,data23;
        $data_raw=explode(";",$raw);
        /*
        $datas = array(
            [0]=>"data11,data12,data13",
            [1]=>"data21,data22,data23"
        )
        */
        for ($i=0; $i < sizeof($data_raw) ; $i++) {
            $data[]=explode(",",$data_raw[$i]);
        }
        /*
        $datas = array(
            [0]=>array(
                [0]=>"data11",
                [1]=>"data12",
                [2]=>"data13"),
            [1]=>array(
                [0]=>"data21",
                [1]=>"data22",
                [2]=>"data23")
        )
        */
        return $data;
    }
}

/* End of file crud_m.php */
/* Location: ./application/models/crud_m.php */