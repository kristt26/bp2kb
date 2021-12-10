<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluargaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'keluarga';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'rtid', 'jumlah_anggota', 'kontak', 'alamat', 'no_rumah'];

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

    public function getKeluarga()
    {
        $db = \Config\Database::connect();
        return $db->query("SELECT
            `keluarga`.*,
            `rw`.`id` AS `rwid`,
            (SELECT penduduk.nama FROM penduduk WHERE penduduk.keluargaid=keluarga.id ORDER BY penduduk.id ASC LIMIT 1) AS nama,
            (SELECT penduduk.nik FROM penduduk WHERE penduduk.keluargaid=keluarga.id ORDER BY penduduk.id ASC LIMIT 1)AS nik,
            (SELECT jawaban.jawaban FROM jawaban WHERE jawaban.keluargaid=keluarga.id)AS pertanyaan
        FROM
            `keluarga`
            LEFT JOIN `rt` ON `keluarga`.`rtid` = `rt`.`id`
            LEFT JOIN `rw` ON `rt`.`rwid` = `rw`.`id`")->getResult();
    }
}