<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class api_siswa extends RestController {

    public function index_get($id=0)
    {
        $check_data = $this->db->get_where('siswa', ['id_siswa'=> $id])->row_array();
        // jika mengisikan id guru
        if($id){
            if($check_data){
                $data = $this->db->get_where('siswa', ['id_siswa'=> $id])->row_array();
                $this->response($data, RestController::HTTP_OK);
            }else{
                $this->response([
                    'status'=>false,
                    'message'=>'Data Tidak Ditemukan',
                ], 404);
            }
        }else{
            $data = $this->db->get('siswa')->result();
            $this->response($data, RestController::HTTP_OK);
        }
    }

    public function index_post()
    {
        $data = array(
            'id_siswa' => $this->post('id_siswa'),
            'nis' => $this->post('nis'),
            'nama_siswa' => $this->post('nama_siswa'),
            'kelas' => $this->post('kelas'),
            'tahun_ajaran' => $this->post('tahun_ajaran'),
            'biaya' => $this->post('biaya')
        );
        $insert = $this->db->insert('siswa', $data);
        if($insert){
            $this->response($data, RestController::HTTP_OK);
        }else{
            $this->response(array('status'=>'failed', 502));
        }
    }

    public function index_put()
    {
        $idsiswa = $this->put('id_siswa');

        $data = array(
            'nis' => $this->put('nis'),
            'nama_siswa' => $this->put('nama_siswa'),
            'kelas' => $this->put('kelas'),
            'tahun_ajaran' => $this->put('tahun_ajaran'),
            'biaya' => $this->put('biaya')
        );

        $this->db->where('id_siswa', $idsiswa);
        $update = $this->db->update('siswa', $data);

        if($update){
            $this->response($data, RestController::HTTP_OK);
        }else{
            $this->response(array('status'=>'failed', 502));
        }
    }

    public function index_delete()
    {
        $idsiswa = $this->delete('id_siswa');
        $check_data = $this->db->get_where('siswa', ['id_siswa'=>$idsiswa])->row_array();

        if($check_data){
            $this->db->where('id_siswa', $idsiswa);
            $this->db->delete('siswa');

            $this->response(array('status'=>'success'), 200);
        }else{
            $this->response(array('status'=>'Data not found'), 404);
        }
    }
}