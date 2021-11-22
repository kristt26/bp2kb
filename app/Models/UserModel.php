<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id', 'username', 'password', 'email'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function check()
    {
        $this->role = new \App\Models\RoleModel();
        $this->userinrole = new \App\Models\UsersInRolesModel();
        $this->petugas = new \App\Models\PetugasModel();
        $this->encrypter = \Config\Services::encrypter();

        $db = \Config\Database::connect();
        try {
            $db->transBegin();
            $num = $this->role->countAllResults();
            if ($db->table('users')->countAllResults() == 0) {
                $user = [
                    "username" => "Administrator",
                    "password" => base64_encode($this->encrypter->encrypt("Admin@123")),
                    "email" => "administrator@mail.com",
                ];
                $db->table('users')->insert($user);
                $user['userid'] = $db->insertID();
                $role = [
                    ["id" => 1, "role" => "Administrator"],
                    ["id" => 2, "role" => "Petugas"],
                ];
                $this->role->insertBatch($role);
                $userrole = [
                    "userid" => $user['userid'],
                    "roleid" => "1",
                ];
                $this->userinrole->insert($userrole);
                $petugas = [
                    "userid" => $user['userid'],
                    "nama" => "Administrator",
                    "alamat" => "-",
                    "telepon" => "-",
                ];
                $this->petugas->insert($petugas);
                if ($db->transStatus()) {
                    $db->transCommit();
                } else {
                    $db->transRollback();
                }

            }
        } catch (\Throwable $th) {
            $db->transRollback();
            return $db->error();

        }

    }
}