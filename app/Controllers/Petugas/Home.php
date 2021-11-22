<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return view('petugas/home');
    }
}