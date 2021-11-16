<?php

namespace App\Controllers\Admin;

use App\Models\KelurahanModel;
use CodeIgniter\RESTful\ResourceController;

class Kecamatan extends ResourceController
{
    protected $modelName = "App\Models\KecamatanModel";
    protected $format = "json";

    public function index()
    {
        return view('admin/kecamatan');
    }

    public function read()
    {
        $kelurahan = new KelurahanModel();
        $data = $this->model->get()->getResultObject();
        foreach ($data as $key => $kecamatan) {
            // $kecamatan->kelurahan = $kelurahan->where('kecamatanid', $kecamatan->id)->findAll();
        }
        return $this->respond($data);
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
        $this->model->uodate($id, $data);
        return $this->respond($data);
    }
    public function delete($id = null)
    {
        $result = $this->model->delete($id);
        return $this->respond($result);
    }

}