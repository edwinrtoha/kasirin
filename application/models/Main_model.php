<?php
    if ( ! defined("BASEPATH")) exit("No direct script access allowed");
    class main_model extends CI_Model{
        var $CI = NULL;
        public function __construct() {
            $this->CI =& get_instance();
        }
        function title($value="",$separator="-"){
            if(empty($value) or $value==""){
                $value=$this->config->item('site_title');
            }
            else{
                $value=$value." ".$separator." ".$this->config->item('site_title');
            }
            return $value;
        }
        function aleart($method,$data=""){
            if($method==0){
                if(is_array($data)){
                    $this->CI->session->set_flashdata('alert','1');
                    $this->CI->session->set_flashdata('alert_type',$data['type']);
                    $this->CI->session->set_flashdata('alert_icon',$data['icon']);
                    $this->CI->session->set_flashdata('alert_title',$data['title']);
                    $this->CI->session->set_flashdata('alert_dismiss',$data['dismiss']);
                    $this->CI->session->set_flashdata('alert_value',$data['value']);
                }
                else{
                }
            }
            else{
            }
        }
    }
?>