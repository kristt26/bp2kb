<?php

namespace App\Controllers\Admin;

use CodeIgniter\RESTful\ResourceController;
use TCPDF;

class Laporan extends ResourceController
{
    public function __construct() {
        $this->kecamatan = new \App\Models\KecamatanModel();
        $this->kelurahan = new \App\Models\KelurahanModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        return view('admin/laporan');
    }
    
    public function read()
    {
        $kecamatans = $this->kecamatan->asObject()->findAll();
        foreach ($kecamatans as $key => $kecamatan) {
            // $kecamatan->kelurahan = $this->kelurahan->select("kelurahan.*, (SELECT COUNT(*) FROM keluarga WHERE rtid=rt.id LEFT JOIN rt on rt.id = keluarga.rtid LEFT JOIN rw on rw.id = rt.rwid LEFT JOIN kelurahans on kelurahans.id = rw.kelurahansid) AS kk")->where('kecamatanid', $kecamatan.id)->getResult();
            $kecamatan->kelurahan = $this->db->query("SELECT kelurahans.*,
                (SELECT COUNT(*) FROM keluarga LEFT JOIN rt on rt.id = keluarga.rtid LEFT JOIN rw on rw.id = rt.rwid WHERE rw.kelurahansid=kelurahans.id) AS kk,
                (SELECT COUNT(*) FROM penduduk LEFT JOIN keluarga on penduduk.keluargaid = keluarga.id LEFT JOIN rt on rt.id = keluarga.rtid LEFT JOIN rw on rw.id = rt.rwid WHERE rw.kelurahansid=kelurahans.id AND penduduk.jenis_kelamin='L') AS pria,
                (SELECT COUNT(*) FROM penduduk LEFT JOIN keluarga on penduduk.keluargaid = keluarga.id LEFT JOIN rt on rt.id = keluarga.rtid LEFT JOIN rw on rw.id = rt.rwid WHERE rw.kelurahansid=kelurahans.id AND penduduk.jenis_kelamin='P') AS wanita,
                (SELECT COUNT(*) FROM rw WHERE rw.kelurahansid=kelurahans.id) AS rw,
                (SELECT COUNT(*) FROM rt LEFT JOIN rw on rw.id = rt.rwid WHERE rw.kelurahansid=kelurahans.id) AS rt
                FROM
                kelurahans
                WHERE kecamatanid='$kecamatan->id'")->getResult();
        }
        return $this->respond($kecamatans);
    }
    
    public function getData()
    {
        $kecamatans = $this->kecamatan->findAll();
        foreach ($kecamatans as $key => $kecamatan) {
            $id = $kecamatan['id'];
            // $kecamatan->kelurahan = $this->kelurahan->select("kelurahan.*, (SELECT COUNT(*) FROM keluarga WHERE rtid=rt.id LEFT JOIN rt on rt.id = keluarga.rtid LEFT JOIN rw on rw.id = rt.rwid LEFT JOIN kelurahans on kelurahans.id = rw.kelurahansid) AS kk")->where('kecamatanid', $kecamatan.id)->getResult();
            $kecamatans[$key]['kelurahan'] = $this->db->query("SELECT kelurahans.*,
                (SELECT COUNT(*) FROM keluarga LEFT JOIN rt on rt.id = keluarga.rtid LEFT JOIN rw on rw.id = rt.rwid WHERE rw.kelurahansid=kelurahans.id) AS kk,
                (SELECT COUNT(*) FROM penduduk LEFT JOIN keluarga on penduduk.keluargaid = keluarga.id LEFT JOIN rt on rt.id = keluarga.rtid LEFT JOIN rw on rw.id = rt.rwid WHERE rw.kelurahansid=kelurahans.id AND penduduk.jenis_kelamin='L') AS pria,
                (SELECT COUNT(*) FROM penduduk LEFT JOIN keluarga on penduduk.keluargaid = keluarga.id LEFT JOIN rt on rt.id = keluarga.rtid LEFT JOIN rw on rw.id = rt.rwid WHERE rw.kelurahansid=kelurahans.id AND penduduk.jenis_kelamin='P') AS wanita,
                (SELECT COUNT(*) FROM rw WHERE rw.kelurahansid=kelurahans.id) AS rw,
                (SELECT COUNT(*) FROM rt LEFT JOIN rw on rw.id = rt.rwid WHERE rw.kelurahansid=kelurahans.id) AS rt
                FROM
                kelurahans
                WHERE kecamatanid='$id'")->getResultArray();
        }
        return $kecamatans;
    }

    public function download()
    {
        $pdf = new TCPDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('OCS');
		$pdf->SetTitle('Rekapitulasi');
		$pdf->SetSubject('Rekapitulasi');
        
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        $pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
        $data = $this->getData();
        foreach ($data as $key => $value) {
            $html = view('admin/download', $value);
            $pdf->AddPage('L', 'A4');
            $pdf->writeHTML($html, true, false, true, false, '');
            // $pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');
        }
        $this->response->setContentType('application/pdf');
        $pdf->Output(date('dmyhis').'.pdf', 'i');
        
    }
}