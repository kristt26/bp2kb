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
    protected $keluarga;
    protected $jawaban;

    public function __construct()
    {
        $this->kelurahan = new \App\Models\KelurahanModel();
        $this->kecamatan = new \App\Models\KecamatanModel();
        $this->wilayah = new \App\Models\WilayahKerjaModel();
        $this->pertanyaan = new \App\Models\KuesionerModel();
        $this->sub = new \App\Models\SubPertanyaanModel();
        $this->rw = new \App\Models\RwModel();
        $this->rt = new \App\Models\RtModel();
        $this->db = \Config\Database::connect();
        $this->encrypter = \Config\Services::encrypter();
        $this->keluarga = new \App\Models\KeluargaModel();
        $this->jawaban = new \App\Models\JawabanModel();
    }

    public function index()
    {
        return view('petugas/penduduk');
    }
    
    public function get($id=null)
    {
        $penduduk = $this->model->where('keluargaid', $id)->get()->getResult();
        foreach ($penduduk as $key => $value) {
            $value->hubungan_keluarga = unserialize($value->hubungan_keluarga);
            isset($value->ibu_kandung) ? $value->ibu_kandung = unserialize($value->ibu_kandung): " ";
        }
        return $this->respond($penduduk);
    }

    public function read()
    {
        $result['kelurahan'] = $this->kelurahan->where("id", session()->get('kelurahanid'))->get()->getRowObject();
        $result['kelurahan']->rw = $this->rw->get()->getResultObject();
        foreach ($result['kelurahan']->rw as $key => $rw) {
            $rw->rt = $this->rt->where('rwid', $rw->id)->findAll();
        }
        $result['pertanyaan'] = $this->pertanyaan->get()->getResultObject();
        foreach ($result['pertanyaan'] as $key => $value) {
            $value->opsi = unserialize($value->opsi);
            if($value->sub_status==1){
                $value->subPertanyaan = $this->sub->where('pertanyaan_id', $value->id)->get()->getResultObject();
                foreach ($value->subPertanyaan as $key => $sub) {
                    $sub->opsi = unserialize($sub->opsi);
                }
            }
        }
        $result['penduduk'] = $this->keluarga->getKeluarga();
        foreach ($result['penduduk'] as $key => $keluarga) {
            $keluarga->pertanyaan = unserialize($keluarga->pertanyaan);
        }
        $result['kecamatan'] = $this->kecamatan->find(session()->get('kecamatanid'));
        return $this->respond($result);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        $this->db->transBegin();
        $this->keluarga->insert($data);
        $data->id = $this->keluarga->getInsertID();
        foreach ($data->penduduk as $key => $penduduk) {
            $penduduk->keluargaid = $data->id;
            $penduduk->hubungan_keluarga = serialize($penduduk->hubungan_keluarga);
            isset($penduduk->ibu_kandung) ? $penduduk->ibu_kandung = serialize($penduduk->ibu_kandung): " ";
            $penduduk->tanggal_lahir = substr($penduduk->tanggal_lahir,0,10);
            $this->model->insert($penduduk);
        }
        $jawaban = [
            'jawaban'=> serialize($data->pertanyaan),
            'keluargaid'=> $data->id
        ];
        $this->jawaban->insert($jawaban);
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
        $result = $this->keluarga->delete($id);
        return $this->respond($result);
    }
}