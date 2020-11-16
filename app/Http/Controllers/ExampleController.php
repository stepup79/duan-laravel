<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    //
    public function hello() {
        return 'Xin chào';
    }
    //
    public function goodbye() {
        return 'Tạm biệt';
    }
    //
    public function gioithieu() {
        $hoten = 'Duy Thái';
        $diachi = 'Cần Thơ';
        return view ('example.gioithieu')
            ->with('hoten', $hoten)
            ->with('diachi', $diachi);
    }
}
