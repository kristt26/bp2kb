<?php

namespace App\Controllers\Admin;

use App\Models\RtModel;
use CodeIgniter\RESTful\ResourceController;

class Rw extends ResourceController
{
    protected $modelName = "App\Models\RwModel";
    protected $format = "json";
    protected $rt;

    public function __construct() {
        $this->rt = new RtModel();
    }

    public function index()
    {
        return view('admin/rw');
    }

    public function read($kelurahansid = null)
    {
        $rt = new RtModel();
        $rws = $this->model->where('kelurahansid', $kelurahansid)->get()->getResultObject();
        foreach ($rws as $keyrw => $rw) {
            $rw->rt = $this->rt->where('rwid', $rw->id)->get()->getResultObject();
        }
        return $this->respond($rws);
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

    public function postrt()
    {
        $data = $this->request->getJSON();
        $this->rt->insert($data);
        $data->id = $this->rt->getInsertID();
        return $this->respond($data);
    }
    public function putrt($id = null)
    {
        $data = $this->request->getJSON();
        $this->rt->uodate($id, $data);
        return $this->respond($data);
    }
    public function deletert($id = null)
    {
        $result = $this->rt->delete($id);
        return $this->respond($result);
    }
}