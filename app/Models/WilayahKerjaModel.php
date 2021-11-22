<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahKerjaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'wilayahkerja';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'kelurahanid', 'petugasid'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getWilayah($petugasid)
    {
        $db = \Config\Database::connect();
        try {
            $data = $db->query("SELECT
                `wilayahkerja`.`id` AS `wilayahid`,
                `wilayahkerja`.`kelurahanid`,
                `kelurahans`.`kelurahan`,
                `kelurahans`.`kecamatanid`,
                `kecamatans`.`kecamatan`
            FROM
                `wilayahkerja`
                LEFT JOIN `kelurahans` ON `wilayahkerja`.`kelurahanid` = `kelurahans`.`id`
                LEFT JOIN `kecamatans` ON `kelurahans`.`kecamatanid` = `kecamatans`.`id` WHERE petugasid='$petugasid'")->getRowObject();
            return $data;
        } catch (\Throwable $th) {
            return $db->error();
        }
    }
}