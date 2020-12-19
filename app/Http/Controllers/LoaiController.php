<?php

namespace App\Http\Controllers;
use App\Loai;
use App\SanPham;
use Illuminate\Http\Request;

class LoaiController extends Controller
{
    public function getdataloai() {
        $dataLoai = Loai::all();
        return view ('example.danhsachloai')
            ->with('dataLoai', $dataLoai);
    }    
    public function getdatasanpham() {
        $dataSanpham = SanPham::all();
        return view ('example.danhsachsanpham')
            ->with('dataSanpham', $dataSanpham);
    }    
}
