@extends('backend.layouts.master')

@section('title')
Đây là trang index Loại
@endsection

@section('content')
<h1>Danh sách table Loại</h1>
<a class="btn btn-primary" href="{{ route('admin.loai.create') }}">Thêm mới</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Mã loại</th>
            <th>Tên loại</th>
            <th>Ngày tạo mới</th>
            <th>Ngày cập nhật</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataLoai as $loai)
        <tr>
            <td>{{ $loai->l_ma }}</td>
            <td>{{ $loai->l_ten }}</td>
            <td>{{ $loai->l_taoMoi }}</td>
            <td>{{ $loai->l_capNhat }}</td>
            <td>
                <a href="{{ route('admin.loai.edit', ['id' => $loai->l_ma]) }}" class="btn btn-warning">Sửa</a>
                <form method="POST" action="{{ route('admin.loai.destroy', ['id' => $loai->l_ma]) }}">
                    <input type="hidden" name="_method" value="DELETE"/>
                    {{ csrf_field() }}
                    <button class="btn btn-danger" type="submit">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection