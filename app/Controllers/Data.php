<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;

class Data extends BaseController
{
    public function add()
    {
        $kec = new KecamatanModel();
        $kel = new KelurahanModel();
        $kecamatan = $this->kecamatan()->kecamatan;
        foreach ($kecamatan as $key => $kecam) {
            $datakec = [
                "kecamatan" => $kecam->nama,
                "jenis" => "Kecamatan",
            ];
            $kec->insert($datakec);
            $datakec['id'] = $kec->getInsertID();
            $kelurahan = $this->kelurahan($kecam->id)->kelurahan;
            foreach ($kelurahan as $key => $value) {
                $datakel = [
                    "kelurahan" => $value->nama,
                    "kecamatanid" => $datakec['id'],
                    "jenis" => "Kelurahan",
                ];
                $kel->insert($datakel);
            }
        }
    }

    public function kelurahan($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }

    public function kecamatan()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=9403",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }

    }
}