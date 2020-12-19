@extends('backend.layouts.master')

@section('title')
Đây là trang edit Loại
@endsection

@section('content')
<h1>Cập nhật loại</h1>
<form name="frmEdit" id="frmEdit" method="POST" action="{{ route('admin.loai.update') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="l_ten">Tên loại</label>
        <input type="text" class="form-control" name="l_ten" id="l_ten" value="{{ old('l_ten') }}">
    </div>
    <div class="form-group">
        <label for="l_trangThai">Trạng thái</label>
        <select class="form-group" name="l_trangThai" id="l_trangThai">
            <option value="1" {{ old('l_trangThai') == 1 ?'selected' :'' }}>Khóa</option>
            <option value="2" {{ old('l_trangThai') == 2 ?'selected' :'' }}>Khả dụng</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Lưu</button>
</form>
@endsection