<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Menu_api extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $this->load->model("Main_model_api");
        $this->load->model("Menu_model");
    }

    function index_get(){
        $result["menu"]=$this->Menu_model->menu()->result();
        echo json_encode($result);
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
        $data["menu"]=$this->Main_model->array_in_param($data["menu"]);
        $data["harga"]=$this->Main_model->array_in_param($data["harga"]);
        $result["menu"] = $this->Menu_model->menu($param)->result();
        echo json_encode($result);
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