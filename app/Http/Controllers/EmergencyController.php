<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmergencyExport;

use App\Models\Emergency;
use Illuminate\Support\Facades\DB;

class EmergencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Emergency::all();
    }

    public function excelReport() {
        return new EmergencyExport();
    }


}
