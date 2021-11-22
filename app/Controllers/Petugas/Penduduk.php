<?php

namespace App\Controllers\Petugas;

use CodeIgniter\RESTful\ResourceController;

class Penduduk extends ResourceController
{
    protected $modelName = "App\Models\PendudukModel";
    protected $format = "json";
    protected $kelurahan;
    protected $kecamatan;
    protected $wilayah;
    protected $rw;
    protected $rt;
    protected $db;

    public function __construct()
    {
        $this->kelurahan = new \App\Models\KelurahanModel();
        $this->kecamatan = new \App\Models\KecamatanModel();
        $this->wilayah = new \App\Models\WilayahKerjaModel();
        $this->rw = new \App\Models\RwModel();
        $this->rt = new \App\Models\RtModel();
        $this->db = \Config\Database::connect();
        $this->encrypter = \Config\Services::encrypter();

    }

    public function index()
    {
        return view('petugas/penduduk');
    }

    public function read()
    {
        $result['kelurahan'] = $this->kelurahan->where("id", session()->get('kelurahanid'))->get()->getRowObject();
        $result['kelurahan']->rw = $this->rw->get()->getResultObject();
        foreach ($result['kelurahan']->rw as $key => $rw) {
            $rw->rt = $this->rt->where('rwid', $rw->id)->findAll();
        }
        return $this->respond($result);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        $this->db->transBegin();
        $user = [
            "username" => $data->username,
            "password" => base64_encode($this->encrypter->encrypt($data->password)),
            "email" => $data->email,
        ];
        $this->user->insert($user);
        $data->userid = $this->user->getInsertID();
        $userrole = [
            "userid" => $data->userid,
            "roleid" => "2",
        ];
        $this->userinrole->insert($userrole);
        $petugas = [
            "userid" => $data->userid,
            "nama" => $data->nama,
            "alamat" => $data->alamat,
            "telepon" => $data->telepon,
        ];
        $this->model->insert($petugas);
        $data->id = $this->model->getInsertID();
        $wilayah = [
            'petugasid' => $data->id,
            'kelurahanid' => $data->kelurahanid,
        ];
        $this->wilayah->insert($wilayah);
        if ($this->db->transStatus()) {
            $this->db->transCommit();
            return $this->respondCreated($data);
        } else {
            $this->db->transRollback();
            return $this->fail($this->db->transStatus());
        }

    }
    public function put($id = null)
    {
        $data = $this->request->getJSON();
        $this->model->update($id, $data);
        return $this->respond($data);
    }
    public function delete($id = null)
    {
        $result = $this->model->delete($id);
        return $this->respond($result);
    }
}