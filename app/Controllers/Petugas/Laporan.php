<?php

namespace App\Controllers\Petugas;

use CodeIgniter\RESTful\ResourceController;
use TCPDF;

class Laporan extends ResourceController
{
    public function __construct() {
        $this->kecamatan = new \App\Models\KecamatanModel();
        $this->kelurahan = new \App\Models\KelurahanModel();
        $this->rw = new \App\Models\RwModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        return view('petugas/laporan');
    }
    
    public function read()
    {
        $kelurahans = $this->kelurahan->asObject()->find(session()->get('kelurahanid'));
        $kelurahans->rws = $this->rw->asObject()->where('kelurahansid', session()->get('kelurahanid'))->findAll();
        foreach ($kelurahans->rws as $key => $rw) {
            // $kecamatan->kelurahan = $this->kelurahan->select("kelurahan.*, (SELECT COUNT(*) FROM keluarga WHERE rtid=rt.id LEFT JOIN rt on rt.id = keluarga.rtid LEFT JOIN rw on rw.id = rt.rwid LEFT JOIN kelurahans on kelurahans.id = rw.kelurahansid) AS kk")->where('kecamatanid', $kecamatan.id)->getResult();
            $rw->rt = $this->db->query("SELECT rt.*,
                (SELECT COUNT(*) FROM keluarga WHERE keluarga.rtid=rt.id) AS kk,
                (SELECT COUNT(*) FROM penduduk LEFT JOIN keluarga on penduduk.keluargaid = keluarga.id WHERE rt.id = keluarga.rtid AND penduduk.jenis_kelamin='L') AS pria,
                (SELECT COUNT(*) FROM penduduk LEFT JOIN keluarga on penduduk.keluargaid = keluarga.id WHERE rt.id = keluarga.rtid AND penduduk.jenis_kelamin='P') AS wanita
                FROM
                rt
                WHERE rwid='$rw->id'")->getResult();
        }
        return $this->respond($kelurahans);
    }
    
    public function getData()
    {
        $kelurahans = $this->kelurahan->find(session()->get('kelurahanid'));
        $kelurahans['rws'] = $this->rw->where('kelurahansid', session()->get('kelurahanid'))->findAll();
        foreach ($kelurahans['rws'] as $key => $rw) {
            $id = $rw['id'];
            // $kecamatan->kelurahan = $this->kelurahan->select("kelurahan.*, (SELECT COUNT(*) FROM keluarga WHERE rtid=rt.id LEFT JOIN rt on rt.id = keluarga.rtid LEFT JOIN rw on rw.id = rt.rwid LEFT JOIN kelurahans on kelurahans.id = rw.kelurahansid) AS kk")->where('kecamatanid', $kecamatan.id)->getResult();
            $kelurahans['rws'][$key]['rt'] = $this->db->query("SELECT rt.*,
            (SELECT COUNT(*) FROM keluarga WHERE keluarga.rtid=rt.id) AS kk,
            (SELECT COUNT(*) FROM penduduk LEFT JOIN keluarga on penduduk.keluargaid = keluarga.id WHERE rt.id = keluarga.rtid AND penduduk.jenis_kelamin='L') AS pria,
            (SELECT COUNT(*) FROM penduduk LEFT JOIN keluarga on penduduk.keluargaid = keluarga.id WHERE rt.id = keluarga.rtid AND penduduk.jenis_kelamin='P') AS wanita
            FROM
            rt
            WHERE rwid='$id'")->getResultArray();
        }
        return $kelurahans['rws'];
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
            $value['key'] = $key;
            $html = view('petugas/download', $value);
            $pdf->AddPage('L', 'A4');
            $pdf->writeHTML($html, true, false, true, false, '');
            // $pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');
        }
        $this->response->setContentType('application/pdf');
        $pdf->Output(date('dmyhis').'.pdf', 'i');
        
    }
}