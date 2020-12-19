<?php

namespace App\Http\Controllers;
use App\Vanchuyen;
use Illuminate\Http\Request;

class VanchuyenController extends Controller
{
    public function getdatavanchuyen() {
        $dataVanchuyen = Vanchuyen::all();
        return view ('example.danhsachvanchuyen')
            ->with('dataVanchuyen', $dataVanchuyen);
    }  
}
