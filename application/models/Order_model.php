<?php
    if ( ! defined("BASEPATH")) exit("No direct script access allowed");
    class order_model extends CI_Model{
        var $CI = NULL;
        public function __construct() {
            $this->CI =& get_instance();
        }

        public function createOrder($data=''){
            if(is_array($data)){
                if(isset($data['order']) && isset($data['order_item'])){
                    if(is_array($data['order']) && is_array($data['order_item'])){
                    }
                }
            }
            // $data['order']=array(
            //     'customer_id'=>,
            //     'take_away'=>,
            //     'gofood'=>,
            //     'grabfood'=>,
            //     'driver_id'=>,
            //     'tanggal'=>,
            // );
            // $data['order_items'][]=array(
            //     'menu_id'=>,
            //     'qty'=>,
            //     'keterangan'=>,
            // );
            $tahun=explode(' ',$data['order']['tanggal']);
            $tahun=explode('-',$tahun[0]);
            $tahun=$tahun[0];
            unset($data["order"]["tanggal"]);
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);
            $query="CREATE TABLE IF NOT EXISTS order_$tahun (order_id int(10) UNSIGNED NOT NULL AUTO_INCREMENT, customer_id varchar(16) NOT NULL, take_away tinyint(1) NOT NULL, gofood tinyint(1) NOT NULL, grabfood tinyint(1) NOT NULL, driver_id varchar(16) NOT NULL, tanggal timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (order_id)) ENGINE=InnoDB DEFAULT CHARSET=latin1;"; // Membuat table order_$tahun jika belum ada table order untuk tahun tersebut
            $this->db->query($query);

            $query="CREATE TABLE IF NOT EXISTS order_items_$tahun (order_id int(11) NOT NULL, menu_id int(11) NOT NULL, qty int(11) NOT NULL, keterangan longtext NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;"; // order_items_$tahun jika belum ada table order_items untuk tahun tersebut
            $this->db->query($query);

            // $this->db->insert('order_'.$tahun,$data['order']);
            $query='INSERT INTO order_2019 (customer_id,take_away,gofood,grabfood,driver_id) VALUES ('.$data["order"]["customer_id"].','.$data["order"]["take_away"].','.$data["order"]["gofood"].','.$data["order"]["grabfood"].','.$data["order"]["driver_id"].')';
            $this->db->query($query);
            $order_id=$this->db->insert_id();

            $customer_id=$data["order"]["customer_id"];
            $this->db->query("INSERT IGNORE INTO customer (customer_id) VALUES ('$customer_id')");

            for ($i=0; $i < sizeof($data["order_items"]) ; $i++) {
                $data["order_items"][$i]["order_id"]=$order_id;
                $this->db->insert('order_items_'.$tahun,$data['order_items'][$i]);
            }

            if ($this->db->trans_status() == FALSE){
                $this->db->trans_rollback();
                return $this->db->trans_status();
            }
            else{
                $this->db->trans_complete();
                return $this->db->trans_status();
            }
        }

        public function getOrder($param){
            if(is_array($param)){
                if(isset($param["tahun"])){
                    $tahun=$param["tahun"];
                    unset($param["tahun"]);
                    $this->db->get('order_'.$tahun,$param);
                }
            }
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
                return $this->db->delete('menu',$param);
            }
        }
    }
?>