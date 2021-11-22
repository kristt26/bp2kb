<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
    use ResponseTrait;
    protected $user;
    protected $role;
    protected $userinrole;
    protected $petugas;
    protected $wilayah;
    protected $encrypter;

    public function __construct(Type $var = null)
    {
        $this->user = new \App\Models\UserModel();
        $this->role = new \App\Models\RoleModel();
        $this->userinrole = new \App\Models\UsersInRolesModel();
        $this->petugas = new \App\Models\PetugasModel();
        $this->wilayah = new \App\Models\WilayahKerjaModel();
        $this->encrypter = \Config\Services::encrypter();
    }

    public function index()
    {
        $this->user->check();
        return view('auth');
    }

    public function login()
    {
        $result = $this->user->where('username', $this->request->getVar("username"))->get()->getRowObject();
        if ($this->request->getVar("password") == $this->encrypter->decrypt(base64_decode($result->password))) {
            $role = $this->userinrole->getRole($result->id);
            $petugas = $this->petugas->where('userid', $result->id)->get()->getRowObject();
            $wilayah = $this->wilayah->getWilayah($petugas->id);
            if ($role->role == "Administrator") {
                $user = [
                    'id' => $petugas->id,
                    'nama' => $petugas->nama,
                    'alamat' => $petugas->alamat,
                    'telepon' => $petugas->telepon,
                    'userid' => $result->id,
                    'role' => $role->role
                ];
                session()->set($user);
                return redirect()->to(base_url('admin/home'));
            } else {
                $user = [
                    'id' => $petugas->id,
                    'nama' => $petugas->nama,
                    'alamat' => $petugas->alamat,
                    'telepon' => $petugas->telepon,
                    'userid' => $result->id,
                    'role' => $role->role,
                    'wilayahid'=>$wilayah->wilayahid,
                    'kelurahanid'=>$wilayah->kelurahanid,
                    'kelurahan'=>$wilayah->kelurahan,
                    'kecamatanid'=>$wilayah->kecamatanid,
                    'kecamatan'=>$wilayah->kecamatan,
                ];
                session()->set($user);
                return redirect()->to(base_url('petugas/home'));
            }

            echo json_encode($user);
        } else {
            return redirect()->back();
        }
    }

    public function checklogin()
    {
        $session = \Config\Services::session();
        try {
            if($session->get('role')){
                return $this->respond(false);
            }else{
                return $this->fail(true);
            }
        } catch (\Throwable $th) {
            echo json_encode($th->getMessage());
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url());
    }
}