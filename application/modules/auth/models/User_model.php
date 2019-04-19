<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class user_model extends CI_Model{

    // public function __construct(){
    //     $this->load->model("auth/Role_model");
    // }

    public function user($param="",$select=""){
        if(isset($select)){
            $this->db->select($select);
        }
        if(is_array($param)){
            return $this->db->get_where("user",$param);
        }
        else{
            return $this->db->get("user");
        }
    }

    public function user_add($data){
        if(empty($data["first_name"]) or $data["first_name"]==""){
            return 1;
        }
        elseif(empty($data["last_name"]) or $data["last_name"]==""){
            return 1;
        }
        elseif(empty($data["birth_place"]) or $data["birth_place"]==""){
            return 1;
        }
        elseif(empty($data["birth_date"]) or $data["birth_date"]==""){
            return 1;
        }
        elseif(empty($data["address"]) or $data["address"]==""){
            return 1;
        }
        elseif(empty($data["email"]) or $data["email"]==""){
            return 1;
        }
        elseif(empty($data["username"]) or $data["username"]==""){
            return 1;
        }
        elseif(empty($data["role"]) or $data["role"]==""){
            return 1;
        }
        elseif($data["password"]!=$data["repassword"]){
            return 1;
        }
        else{
            $this->main_model->alert(array('type'=>'success','icon'=>'check','title'=>'Berhasil','dismiss'=>'yes','value'=>'Informasi akun berhasil di tambahkan'));
            return $this->db->insert("user",$data);
        }
    }

    public function user_edit($data,$param=""){
        if(is_array($data)){
            if(isset($data["param"])){
                unset($data["param"]);
            }
            if(is_array($param)){
                return $this->db->update('user',$data,$param);
            }
            else{
                return $this->db->update('user',$data);
            }
        }
        else{
            return false;
        }
    }

    public function user_del($param){
        if($this->User_model->user($param)->num_rows()!=0){
            if(is_array($param)){
                return $this->db->delete("user",$param);
            }
            else{
                return $this->db->delete("user");
            }
        }
        else{
            $this->main_model->alert(0,array('type'=>'danger','icon'=>'ban','title'=>'Gagal','dismiss'=>'yes','value'=>'Data tidak temukan'));
            return false;
        }
    }
}