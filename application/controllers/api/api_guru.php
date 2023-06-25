<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class api_guru extends RestController {

    public function index_get($id=0)
    {
        $check_data = $this->db->get_where('guru', ['id_guru'=> $id])->row_array();
        // jika mengisikan id guru
        if($id){
            if($check_data){
                $data = $this->db->get_where('guru', ['id_guru'=> $id])->row_array();
                $this->response($data, RestController::HTTP_OK);
            }else{
                $this->response([
                    'status'=>false,
                    'message'=>'Data Tidak Ditemukan',
                ], 404);
            }
        }else{
            $data = $this->db->get('guru')->result();
            $this->response($data, RestController::HTTP_OK);
        }
    }

    public function index_post()
    {
        $data = array(
            'id_guru' => $this->post('id_guru'),
            'nama_guru' => $this->post('nama_guru')
        );
        $insert = $this->db->insert('guru', $data);
        if($insert){
            $this->response($data, RestController::HTTP_OK);
        }else{
            $this->response(array('status'=>'failed', 502));
        }
    }

    public function index_put()
    {
        $idguru = $this->put('id_guru');

        $data = array(
            'nama_guru' => $this->put('nama_guru'),
        );

        $this->db->where('id_guru', $idguru);
        $update = $this->db->update('guru', $data);

        if($update){
            $this->response($data, RestController::HTTP_OK);
        }else{
            $this->response(array('status'=>'failed', 502));
        }
    }

    public function index_delete()
    {
        $idguru = $this->delete('id_guru');
        $check_data = $this->db->get_where('guru', ['id_guru'=>$idguru])->row_array();

        if($check_data){
            $this->db->where('id_guru', $idguru);
            $this->db->delete('guru');

            $this->response(array('status'=>'success'), 200);
        }else{
            $this->response(array('status'=>'Data not found'), 404);
        }
    }
}