<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'petugas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'userid', 'nama', 'alamat', 'telepon'];

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

    public function select()
    {
        $db = \Config\Database::connect();
        try {
        $data = $db->query("SELECT
            `petugas`.`id`,
            `petugas`.`nama`,
            `petugas`.`alamat`,
            `petugas`.`telepon`,
            `petugas`.`userid`,
            `users`.`username`,
            `users`.`password`,
            `users`.`email`,
            `roles`.`role`,
            `kelurahans`.`kelurahan`,
            `kelurahans`.`id` AS kelurahanid,
            `kelurahans`.`jenis`,
            `kecamatans`.`kecamatan`
        FROM
            `petugas`
            LEFT JOIN `users` ON `users`.`id` = `petugas`.`userid`
            LEFT JOIN `usersinroles` ON `usersinroles`.`userid` = `users`.`id`
            LEFT JOIN `roles` ON `roles`.`id` = `usersinroles`.`roleid`
            LEFT JOIN `wilayahkerja` ON `petugas`.`id` = `wilayahkerja`.`petugasid`
            LEFT JOIN `kelurahans` ON `wilayahkerja`.`kelurahanid` = `kelurahans`.`id`
            LEFT JOIN `kecamatans` ON `kecamatans`.`id` = `kelurahans`.`kecamatanid`")->getResult();
        return $data;
        } catch (\Throwable $th) {
            return $db->error();
        }
    }
}
