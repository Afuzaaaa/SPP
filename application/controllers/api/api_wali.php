<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;


class api_wali extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->model('Wali_m');
    }

    // Endpoint untuk mendapatkan data berdasarkan where
    public function get_where_get($table, $where) {
        $data = $this->Wali_m->get_where($table, $where)->result_array();
        $this->response($data, RestController::HTTP_OK);
    }

    // Endpoint untuk mendapatkan semua data dari suatu tabel
    public function get_get($table) {
        $data = $this->Wali_m->get($table)->result_array();
        $this->response($data, RestController::HTTP_OK);
    }

    // Endpoint untuk menyisipkan data ke dalam tabel
    public function insert_post($table) {
        $data = $this->post();
        $this->Wali_m->insert($table, $data);
        $this->response(['message' => 'Data inserted successfully.'], RestController::HTTP_CREATED);
    }

    // Endpoint untuk mengupdate data dalam tabel
    public function update_post($table) {
        $data = $this->post();
        $this->Wali_m->update($table, $data);
        $this->response(['message' => 'Data updated successfully.'], RestController::HTTP_OK);
    }

    // Endpoint untuk mendapatkan data join antara dua tabel
    public function get_join_get($table1, $table2) {
        $data = $this->Wali_m->get_join($table1, $table2)->result_array();
        $this->response($data, RestController::HTTP_OK);
    }
}
