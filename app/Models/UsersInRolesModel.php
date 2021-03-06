<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersInRolesModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'usersinroles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id', 'userid', 'roleid'];

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

    public function getRole($userid)
    {
        $db = \Config\Database::connect();
        try {
            $data = $db->query("SELECT
                *
                FROM
                `usersinroles`
                LEFT JOIN `roles` ON `usersinroles`.`roleid` = `roles`.`id` WHERE userid='$userid'")->getRowObject();
            return $data;
        } catch (\Throwable $th) {
            return $db->error();
        }

    }
}