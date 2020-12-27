<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Loai;
use Carbon\Carbon;
use Validator;
use Session;
use App\Http\Requests\LoaiCreateRequest;
use Barryvdh\DomPDF\Facade as PDF;

class LoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataLoai = Loai::all();
            return view('backend.loai.index')
                ->with('dataLoai', $dataLoai);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.loai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoaiCreateRequest $request)
    {
        // Lấy dữ liệu người dùng Input
        $l_ten = $request->l_ten;
        $l_trangThai = $request->l_trangThai;
        // dd($request); //Dump and die

        // //Validation dữ liệu
        // $validator = Validator::make($request->all(), [
        //     'l_ten' =>  'required|min:3|max:50|unique:pal_loai',
        //     'l_trangThai' => 'required',
        // ]);
        // // Nếu kiểm tra ràng buộc dữ liệu thất bại -> tức là dữ liệu không hợp lệ
        // // Chuyển hướng về view "Thêm mới" với,
        // // - Thông báo lỗi vi phạm các quy luật.
        // // - Dữ liệu cũ (người dùng đã nhập).
        // if ($validator->fails()) {
        //     return redirect(route('admin.loai.create'))
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }
        
        // Nạp dữ liệu vào Database
        $loai = new Loai();
        $loai->l_ten = $l_ten;
        $loai->l_taoMoi = Carbon::now();
        $loai->l_capNhat = Carbon::now();
        $loai->l_trangThai = $l_trangThai;
        $loai->save();

        // Save thành công điều hướng về route index
        return redirect(route('admin.loai.index'));
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
        $loai = Loai::find($id);

        return view('backend.loai.edit')
            ->with('loai', $loai);
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
        $loai = Loai::find($id);

        $loai->l_ten = $request->l_ten;
        $loai->l_taoMoi = $request->l_taoMoi;
        $loai->l_capNhat = $request->l_capNhat;
        $loai->l_trangThai = $request->l_trangThai;
        $loai->save();

        // Hiển thị câu thông báo 1 lần (Flash session)
        Session::flash('alert-info', 'Cập nhật thành công ^^~!!!');
        
        // Điều hướng về trang index
        return redirect()->route('admin.loai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loai = Loai::find($id);

        $loai->delete();
        // Hiển thị câu thông báo 1 lần (Flash session)
        Session::flash('alert-info', 'Xóa loại sản phẩm thành công ^^~!!!');

        // Điều hướng về trang index
        return redirect()->route('admin.loai.index');
    }

    /**
     * Action xuất PDF
     */
    public function pdf()
    {
        $ds_loai = Loai::all();
        $data = [
            'danhsachloai' => $ds_loai
        ];
        /* Code dành cho việc debug
        - Khi debug cần hiển thị view để xem trước khi Export PDF
        */
        // return view('backend.loai.pdf')
        //     ->with('danhsachloai', $ds_loai);
        $pdf = PDF::loadView('backend.loai.pdf', $data);
        return $pdf->download('DanhMucLoai.pdf');
    }
}
