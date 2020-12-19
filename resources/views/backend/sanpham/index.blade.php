@extends('backend.layouts.master')

@section('title')
Đây là trang index Sản Phẩm
@endsection

@section('content')
<a class="btn btn-primary" href="{{ route('admin.sanpham.create') }}">Thêm mới</a>
<table class="table table-striped">
    <tr>
        <th>Mã sản phẩm</th>
        <th>Tên</th>
        <th>Giá sản phẩm</th>
        <th>Hình</th>
        <th>Thông tin</th>
        <th>Trạng thái</th>
        <th>Loại sản phẩm</th>
    </tr>
    @foreach($dsSanPham as $sp)
        <tr>
            <td>{{ $sp->sp_ma }}</td>
            <td>{{ $sp->sp_ten }}</td>
            <td>{{ $sp->sp_giaGoc }}</td>
            <td>{{ $sp->sp_hinh }}</td>
            <td>{{ $sp->sp_thongTin }}</td>
            <td>{{ $sp->sp_trangThai }}</td>
            <td>{{ $sp->loaiSanpham->l_ten }}</td>
        </tr>
    @endforeach
</table>

@endsection