<?php

namespace App\Controllers\Admin;

use App\Models\KecamatanModel;
use App\Models\RtModel;
use App\Models\RwModel;
use CodeIgniter\RESTful\ResourceController;

class Kelurahan extends ResourceController
{
    protected $modelName = "App\Models\KelurahanModel";
    protected $format = "json";

    public function index()
    {
        return view('admin/kelurahan');
    }

    public function read($kecamatanid = null)
    {
        $kec = new KecamatanModel();
        $rw = new RwModel();
        $rt = new RtModel();
        $kecamatan = $kec->where('id', $kecamatanid)->get()->getRowObject();
        $kecamatan->kelurahan = $this->model->where('kecamatanid', $kecamatan->id)->findAll();
        // $data->rw = $rw->get()->getResultObject();
        // foreach ($$data->rw as $key => $value) {
        //     $value->rt = $rt->where('rwid', $value->id)->findAll();
        // }
        return $this->respond($kecamatan);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        $this->model->insert($data);
        $data->id = $this->model->getInsertID();
        return $this->respond($data);
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