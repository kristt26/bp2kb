<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;

class Kuesioner extends ResourceController
{
    protected $modelName = "App\Models\KuesionerModel";
    protected $format = "json";
    protected $sub;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->sub = new \App\Models\SubPertanyaanModel();
        $this->encrypter = \Config\Services::encrypter();

    }

    public function index()
    {
        return view('admin/kuesioner');
    }

    public function read()
    {
        $result = $this->model->findAll();
        return $this->respond($result);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        $this->db->transStart();
        if (isset($data->opsi)) {
            $data->opsi = serialize($data->opsi);
        } else {
            $data->opsi = null;
        }
        $this->model->insert($data);
        $data->id = $this->model->getInsertID();
        if (isset($data->subPertanyaan)) {
            foreach ($data->subPertanyaan as $key => $value) {
                $value->pertanyaan_id = $data->id;
                $value->opsi = serialize($value->opsi);
                $this->sub->insert($value);
                $value->id = $this->sub->getInsertID();
            }
        }
        if ($this->db->transStatus) {
            $this->db->transCommit();
            return $this->respondCreated($data);
        } else {
            $this->db->transRollback();
            return $this->fail("error");
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