<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Order_api extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model("Main_model_api");
        $this->load->model("Order_model");
        // $this->load->model("Menu_model");
    }

    function index_get(){
        // $result["menu"]=$this->Menu_model->menu()->result();
        // echo json_encode($result);
    }

    //Menampilkan data kontak
    function index_post() {
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
        $data=$this->post();
        $data["order"]=explode(",",$data["order"]);
        $data['order']=array(
                'customer_id'=>$data["order"][0],
                'take_away'=>$data["order"][1],
                'gofood'=>$data["order"][2],
                'grabfood'=>$data["order"][3],
                'driver_id'=>$data["order"][4],
                'tanggal'=>$data["order"][5],
            );
        $order_items_temp=$this->Main_model_api->string_to_array($data["order_items"],0);
        unset($data["order_items"]);
        for ($i=0; $i < sizeof($order_items_temp) ; $i++) {
            if(sizeof($order_items_temp[$i]) == 3){
                $data["order_items"][]=array(
                    "menu_id"=>$order_items_temp[$i][0],
                    "qty"=>$order_items_temp[$i][1],
                    "keterangan"=>$order_items_temp[$i][2]
                );
            }
        }
        unset($order_items_temp);
        $insert=$this->Order_model->createOrder($data);
        if ($insert) {
            $this->response($insert, 200);
        }
        else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    // function index_post(){
    //     $insert=$this->Trx_model->trx_add($this->post());
    //     if ($insert) {
    //         $this->response($data, 200);
    //     }
    //     else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }

    // function index_put(){
    //     $data=$this->put();
    //     $param=$this->put('param');
    //     $param=$this->Main_model_api->array_in_param($param);
    //     $update = $this->Trx_model->trx_edit($data,$param);
    //     if ($update) {
    //         $this->response($data, 200);
    //     } else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }

    // function index_delete(){
    //     $delete = $this->Trx_model->trx_del(array("id"=>$this->input->post("id")));
    //     if ($delete) {
    //         $this->response(array('status' => 'success'), 201);
    //     } else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }

    //Masukan function selanjutnya disini
}
?>