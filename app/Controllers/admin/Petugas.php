<?php

namespace App\Controllers\Admin;

use App\Models\KecamatanModel;
use CodeIgniter\RESTful\ResourceController;

class Petugas extends ResourceController
{
    protected $modelName = "App\Models\PetugasModel";
    protected $format = "json";
    protected $user;
    protected $role;
    protected $userinrole;
    protected $kelurahan;
    protected $kecamatan;
    protected $wilayah;
    protected $db;

    public function __construct() {
        $this->user = new \App\Models\UserModel();
        $this->role = new \App\Models\RoleModel();
        $this->userinrole = new \App\Models\UsersInRolesModel();
        $this->kelurahan = new \App\Models\KelurahanModel();
        $this->kecamatan = new \App\Models\KecamatanModel();
        $this->wilayah = new \App\Models\WilayahKerjaModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('admin/petugas');
    }

    public function read()
    {
        $result['petugas'] = $this->model->select();
        $result['role'] = $this->role->findAll();
        $result['kecamatan'] = $this->kecamatan->findAll();
        $result['kelurahan'] = $this->kelurahan->findAll();
        return $this->respond($result);
    }

    public function post()
    {
        $data = $this->request->getJSON();
        $this->db->transBegin();
        $user = [
            "username"=>$data->username,
            "password"=>password_hash($data->password, PASSWORD_DEFAULT),
            "email"=>$data->email,
        ];
        $this->user->insert($user);
        $data->userid = $this->user->getInsertID();
        $userrole = [
            "userid"=>$data->userid,
            "roleid"=>"2"
        ];
        $this->userinrole->insert($userrole);
        $petugas = [
            "userid"=>$data->userid,
            "nama"=>$data->nama,
            "alamat"=>$data->alamat,
            "telepon"=>$data->telepon,
        ];
        $this->model->insert($petugas);
        $data->id = $this->model->getInsertID();
        $wilayah = [
            'petugasid'=>$data->id,
            'kelurahanid'=>$data->kelurahanid
        ];
        $this->wilayah->insert($wilayah);
        if($this->db->transStatus()){
            $this->db->transCommit();
            return $this->respondCreated($data);
        }else{
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