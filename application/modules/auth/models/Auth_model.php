<?php
if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class auth_model extends CI_Model {
    // SET SUPER GLOBAL
    var $CI = NULL;
    var $dbtable_setting=array(
        "table_name"=>"user",
        "username_col_name"=>"username",
        "password_col_name"=>"password"
    );
    public function __construct() {
        $this->CI =& get_instance();
        $this->load->model("auth/User_model");
    }
    // Fungsi login
    public function login($username, $password) {
        $query=$this->User_model->user(array("username"=>$username,"password"=>$password));
        if($query->num_rows() == 1) {
            $data=$query->row();
            $login=array(
                "username"=>$username,
                "id"=>$data->id
            );
            $this->CI->session->set_userdata('login',$login);
            redirect(base_url('dashboard'));
        }
        else{
            $this->CI->session->set_flashdata('sukses','Oops... Username/password salah');
            redirect(base_url('auth/login'));
        }
        return false;
    }
    // login with oauth
    public function login_oauth($oauth_uid){
        $query=$this->User_model->user(array("google_uid"=>$oauth_uid));
        if($query->num_rows() == 1) {
            $data=$query->row();
            $login=array(
                "username"=>$username,
                "id_login"=>rand(uniqid()),
                "role"=>$query->role,
                "id"=>$data->id
            );
            $this->CI->session->set_userdata('login',$login);
            redirect(base_url('dashboard'));
        }
        else{
            $this->CI->session->set_flashdata('sukses','Oops... Username/password salah');
            redirect(base_url('login'));
        }
        return false;
    }
    // Proteksi halaman
    public function cek_login() {
        if(!$this->CI->session->userdata('login')) {
            return 0;
        }
        else{
            // $this->CI->session->set_flashdata('login_status','1');
            return 1;
        }
    }

    // Fungsi logout
    public function logout() {
        $this->CI->session->unset_userdata('login');
        $this->CI->session->set_flashdata('sukses','Anda berhasil logout');
        redirect(base_url('auth/login'));
    }
    // Login Profil
    public function user_login(){
        if($this->CI->session->userdata('login')){
            $uid=$this->CI->session->userdata('login')["id"];
            $query=$this->User_model->user(array("id"=>$uid));
            return $query;
        }
    }
}

/* End of file crud_m.php */
/* Location: ./application/models/crud_m.php */