<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Loai; 
use DB;
use Mail;
use App\Mail\ContactMailer;

class FrontendController extends Controller
{
    /**
     * Action hiển thị view Trang chủ
     * GET /
     */
    public function index(Request $request)
    {
        // Query top 3 loại sản phẩm (có sản phẩm) mới nhất
        $ds_top3_newest_loaisanpham = DB::table('pal_loai')
            ->join('pal_sanpham', 'pal_loai.l_ma', '=', 'pal_sanpham.l_ma')
            ->orderBy('l_capNhat')->take(3)->get();

        // Query tìm danh sách sản phẩm
        $danhsachsanpham = $this->searchSanPham($request);
        // Hiển thị view `frontend.index` với dữ liệu truyền vào
        return view('frontend.index')
            ->with('ds_top3_newest_loaisanpham', $ds_top3_newest_loaisanpham)
            ->with('danhsachsanpham', $danhsachsanpham);
    }
    /**
     * Hàm query danh sách sản phẩm theo nhiều điều kiện
     */
    private function searchSanPham(Request $request)
    {
        $query = DB::table('pal_sanpham')->select('*');
        // Kiểm tra điều kiện `searchByLoaiMa`
        $searchByLoaiMa = $request->query('searchByLoaiMa');
        if ($searchByLoaiMa != null) {
        }

        $data = $query->get();
        return $data;
    }

    // action hiển thị view liên hệ
    public function contact() {
        return view('frontend.pages.contact');
    }

    public function sendMailContactForm(Request $request)
    {
        // $email = $request->email;
        // $message = $request->message;
        // dd($email,$message);

        $input = $request->all();

        // Mail chuyên gửi(thaiduy6995@gmail.com)=> gửi cho quản trị với nội dung email + lời nhắn
        Mail::to('thaiduy6995@gmail.com')->send(new ContactMailer($input));
    }
}
