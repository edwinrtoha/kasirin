<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Test extends REST_Controller {

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
        $raw="1,3,coba;2,7,coba2;0;5161;;;";
        $converted=$this->Main_model_api->string_to_array($raw,0);
        print_r($this->Main_model_api->string_to_array($raw,0));

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