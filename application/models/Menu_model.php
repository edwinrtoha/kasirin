<?php
    if ( ! defined("BASEPATH")) exit("No direct script access allowed");
    class menu_model extends CI_Model{
        var $CI = NULL;
        public function __construct() {
            $this->CI =& get_instance();
        }
        public function menu($param=""){
            // $this->db->query("SELECT menu.*,menu_kategori.*,menu_update.*
            // FROM `menu_update`
            // RIGHT JOIN `menu` ON menu.menu_id=menu_update.menu_id
            // LEFT JOIN `menu_kategori` ON menu.kategori_id=menu_kategori.kategori_id");
            // $this->db->join('menu_kategori', 'menu.kategori = menu_kategori.id', 'left');
            // $this->db->join('menu_update', 'menu.id = menu_update.idMenu');
            $this->db->select("menu.*,menu_kategori.nama kategori_nama,menu_update.harga,menu_update.valid_from,menu_update.valid_until,menu_update.updated");
            $this->db->join('menu', 'menu.menu_id=menu_update.menu_id','right');
            $this->db->join('menu_kategori', 'menu.kategori_id=menu_kategori.kategori_id');
            $this->db->order_by("menu.menu_id ASC, menu_update.valid_from DESC");
            if(is_array($param)){
                return $this->db->get_where("menu_update",$param);
            }
            else{
                return $this->db->get("menu_update");
            }
        }

        public function tambah($data=array()){
            // $data["menu"]=array(
            //     "nama"=>,
            //     "kategori"=>,
            //     "status"=>,
            // );
            // $data["harga"][]=array(
            //     "harga"=>,
            //     "dine_in"=>,
            //     "take_away"=>,
            //     "gofood"=>,
            //     "grabfood"=>,
            //     "valid_from"=>,
            //     "valid_until"=>
            // );
            $menu=$this->db->insert("menu",$data["menu"]);
            $idMenu=$this->db->insert_id();
            $loop_harga=sizeof($data["harga"]);

            for($i=0;$i<$loop_harga;$i++){
                $data["menu"][$i]["idMenu"]=$idMenu;
                $this->Menu_model->update($data["menu"][$i]);
            }
        }

        public function update($data=""){
            // $data["harga"]=array(
            //     "idMenu"=>,
            //     "harga"=>,
            //     "dine_in"=>,
            //     "take_away"=>,
            //     "gofood"=>,
            //     "grabfood"=>,
            //     "valid_from"=>,
            //     "valid_until"=>
            // );
            if(is_array($data)){
                if(!is_numeric($data["idMenu"])){
                }
                else if(!is_numeric($data["harga"])){
                }
                else if(!is_bool($data["dine_in"])){
                }
                else if(!is_bool($data["take_away"])){
                }
                else if(!is_bool($data["gofood"])){
                }
                else if(!is_bool($data["grabfood"])){
                }
                else{
                    return $this->db->insert("menu_update",$data);
                }
            }
        }

        public function delete($param=""){
            if(is_array($param)){
                return $this->db->delete('menu'=>$param);
            }
        }
    }
?>