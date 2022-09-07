<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataContractController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.kontrak.index');
    }

    public function create()
    {
        return view('pages.dashboard.kontrak.create');
    }
}
