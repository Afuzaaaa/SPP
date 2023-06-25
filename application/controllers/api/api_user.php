<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class api_user extends RestController {

    public function index_get($id=0)
    {
        $check_data = $this->db->get_where('users', ['id_user'=> $id])->row_array();
        // jika mengisikan id guru
        if($id){
            if($check_data){
                $data = $this->db->get_where('users', ['id_user'=> $id])->row_array();
                $this->response($data, RestController::HTTP_OK);
            }else{
                $this->response([
                    'status'=>false,
                    'message'=>'Data Tidak Ditemukan',
                ], 404);
            }
        }else{
            $data = $this->db->get('users')->result();
            $this->response($data, RestController::HTTP_OK);
        }
    }

    public function index_post()
    {
        $data = array(
            'id_user' => $this->post('id_user'),
            'username' => $this->post('username'),
            'password' => $this->post('password'),
            'nama_lengkap' => $this->post('nama_lengkap')
        );
        $insert = $this->db->insert('users', $data);
        if($insert){
            $this->response($data, RestController::HTTP_OK);
        }else{
            $this->response(array('status'=>'failed', 502));
        }
    }

    public function index_put()
    {
        $iduser = $this->put('id_user');

        $data = array(
            'nama_lengkap' => $this->put('nama_lengkap'),
            'username' => $this->put('username'),
            'password' => $this->put('password')
        );

        $this->db->where('id_user', $iduser);
        $update = $this->db->update('users', $data);

        if($update){
            $this->response($data, RestController::HTTP_OK);
        }else{
            $this->response(array('status'=>'failed', 502));
        }
    }

    public function index_delete()
    {
        $iduser = $this->delete('id_user');
        $check_data = $this->db->get_where('users', ['id_user'=>$iduser])->row_array();

        if($check_data){
            $this->db->where('id_user', $iduser);
            $this->db->delete('users');

            $this->response(array('status'=>'success'), 200);
        }else{
            $this->response(array('status'=>'Data not found'), 404);
        }
    }
}