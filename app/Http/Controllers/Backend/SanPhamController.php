<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SanPham;
use App\Loai;
use Carbon\Carbon;
use Storage;
use Session;
use App\HinhAnh;
use App\Exports\SanPhamExport;
use Maatwebsite\Excel\Facades\Excel as Excel;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Khi sử dụng MODEL phải use chúng
        $dsSanPham = SanPham::all();
        return view ('backend.sanpham.index')
            ->with('dsSanPham', $dsSanPham);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dsLoai = Loai::all();
        return view('backend.sanpham.create')
            ->with('dsLoai', $dsLoai);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        // Tạo mới object SanPham
        $sp = new SanPham();
        $sp->sp_ten = $request->sp_ten;
        $sp->sp_giaGoc = $request->sp_giaGoc;
        $sp->sp_giaBan = $request->sp_giaBan;
        $sp->sp_thongTin = $request->sp_thongTin;
        $sp->sp_danhGia = $request->sp_danhGia;
        $sp->sp_taoMoi = $request->sp_taoMoi;
        $sp->sp_capNhat = $request->sp_capNhat;
        // $sp->sp_taoMoi = Carbon::now();
        // $sp->sp_capNhat = Carbon::now();
        $sp->sp_trangThai = $request->sp_trangThai;
        $sp->l_ma = $request->l_ma;

        if($request->hasFile('sp_hinh')) {
            $file = $request->sp_hinh;
            // 1. Lưu tên hình vào cột sp_hinh
            $sp->sp_hinh = $file->getClientOriginalName();

            // 2. Chép file vào thư mục "photos"
            // thư mục gốc storage/app
            // ánh xạ thư mục: php artisan storage:link
            $fileSaved = $file->storeAs('public/photos', $sp->sp_hinh);
        }
        $sp->save();

        // Lưu hình ảnh liên quan
        if($request->hasFile('sp_hinhanhlienquan')) {
            $files = $request->sp_hinhanhlienquan;

            // duyệt từng ảnh và thực hiện lưu
            foreach ($request->sp_hinhanhlienquan as $index => $file) {
                
                $file->storeAs('public/photos', $file->getClientOriginalName());

                // Tạo đối tưọng HinhAnh
                $hinhAnh = new HinhAnh();
                $hinhAnh->sp_ma = $sp->sp_ma;
                $hinhAnh->ha_stt = ($index + 1);
                $hinhAnh->ha_ten = $file->getClientOriginalName();
                $hinhAnh->save();
            }
        }
        // Hiển thị câu thông báo 1 lần (Flash session)
        Session::flash('alert-info', 'Them moi thanh cong ^^~!!!');

        // Save thành công điều hướng về route index
        return redirect(route('admin.sanpham.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Sử dụng Eloquent Model để truy vấn dữ liệu 
        $sp = SanPham::where("sp_ma", $id)->first(); 
        $ds_loai = Loai::all(); 
        
        // Đường dẫn đến view được quy định như sau: <FolderName>.<ViewName> 
        // Mặc định đường dẫn gốc của method view() là thư mục `resources/views` 
        // Hiển thị view `backend.sanpham.edit` 
        return view('backend.sanpham.edit')
            // với dữ liệu truyền từ Controller qua View, được đặt tên là `sp` và `danhsachloai`
            ->with('sp', $sp)
            ->with('danhsachloai', $ds_loai);
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Tìm object Sản phẩm theo khóa chính
        $sp = SanPham::where("sp_ma",  $id)->first();
        $sp->sp_ten = $request->sp_ten;
        $sp->sp_giaGoc = $request->sp_giaGoc;
        $sp->sp_giaBan = $request->sp_giaBan;
        $sp->sp_thongTin = $request->sp_thongTin;
        $sp->sp_danhGia = $request->sp_danhGia;
        $sp->sp_taoMoi = $request->sp_taoMoi;
        $sp->sp_capNhat = $request->sp_capNhat;
        $sp->sp_trangThai = $request->sp_trangThai;
        $sp->l_ma = $request->l_ma;

        // Kiểm tra xem người dùng có upload hình ảnh Đại diện hay không?
        if($request->hasFile('sp_hinh'))
        {
            // Xóa hình cũ để tránh rác
            // file gốc stogare/app
            Storage::delete('public/photos/' . $sp->sp_hinh);

            // Upload hình mới
            // Lưu tên hình vào column sp_hinh
            $file = $request->sp_hinh;
            $sp->sp_hinh = $file->getClientOriginalName();
            
            // Chép file vào thư mục "photos"
            // file ánh xạ
            $fileSaved = $file->storeAs('public/photos', $sp->sp_hinh);
        }
        // Lưu hình ảnh liên quan
        if ($request->hasFile('sp_hinhanhlienquan')) {
            // DELETE các dòng liên quan trong table `HinhAnh`
            foreach ($sp->hinhanhlienquan()->get() as $hinhAnh) {
                // Xóa hình cũ để tránh rác
                Storage::delete('public/photos/' . $hinhAnh->ha_ten);

                // Xóa record
                $hinhAnh->delete();
            }

            $files = $request->sp_hinhanhlienquan;

            // duyệt từng ảnh và thực hiện lưu
            foreach ($request->sp_hinhanhlienquan as $index => $file) {

                $file->storeAs('public/photos', $file->getClientOriginalName());

                // Tạo đối tưọng HinhAnh
                $hinhAnh = new HinhAnh();
                $hinhAnh->sp_ma = $sp->sp_ma;
                $hinhAnh->ha_stt = ($index + 1);
                $hinhAnh->ha_ten = $file->getClientOriginalName();
                $hinhAnh->save();
            }
        }
        $sp->save();

        // Hiển thị câu thông báo 1 lần (Flash session)
        Session::flash('alert-info', 'Cập nhật thành công ^^~!!!');
        
        // Điều hướng về trang index
        return redirect()->route('admin.sanpham.index');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Tìm object Sản phẩm theo khóa chính
        $sp = SanPham::where("sp_ma",  $id)->first();

        // Nếu tìm thấy được sản phẩm thì tiến hành thao tác DELETE
        if(empty($sp) == false)
        {
            // DELETE các dòng liên quan trong table `HinhAnh` 
            foreach ($sp->hinhanhlienquan()->get() as $hinhAnh) {
                // Xóa hình cũ để tránh rác 
                Storage::delete('public/photos/' . $hinhAnh->ha_ten);

                // Xóa record 
                $hinhAnh->delete();
            }
            // Xóa hình cũ để tránh rác
            Storage::delete('public/photos/' . $sp->sp_hinh);
        }
        $sp->delete();

        // Hiển thị câu thông báo 1 lần (Flash session)
        Session::flash('alert-info', 'Xóa sản phẩm thành công ^^~!!!');

        // Điều hướng về trang index
        return redirect()->route('admin.sanpham.index');
    }

    public function print()
    {
        $dsSanPham = SanPham::all();
        $dsLoai = Loai::all();
        
        return view('backend.sanpham.print')
            ->with('danhsachsanpham', $dsSanPham)
            ->with('danhsachloai', $dsLoai);
    }

    /**
     * Action xuất Excel
     */
    public function excel() 
    {
        /* Code dành cho việc debug
        - Khi debug cần hiển thị view để xem trước khi Export Excel
        */
        // $ds_sanpham = Sanpham::all();
        // $ds_loai    = Loai::all();
        // return view('backend.sanpham.excel')
        //     ->with('danhsachsanpham', $ds_sanpham)
        //     ->with('danhsachloai', $ds_loai);

        return Excel::download(new SanPhamExport, 'danhsachsanpham.xlsx');
    }
}
