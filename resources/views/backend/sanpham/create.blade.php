@extends('backend.layouts.master')

@section('title')
Đây là trang create Sản Phẩm
@endsection

@section('custom-css')
<!-- CSS dành cho thư viện bootstrap-fileinput -->
<link href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<link href="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<h1>Thêm sản phẩm</h1>
<form name="frmCreate" id="frmCreate" method="POST" action="{{ route('admin.sanpham.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="sp_ten">Tên sản phẩm</label>
        <input type="text" class="form-control" name="sp_ten" id="sp_ten" value="{{ old('sp_ten') }}">
    </div>
    <div class="form-group">
        <label for="sp_giaGoc">Giá gốc</label>
        <input type="text" class="form-control" name="sp_giaGoc" id="sp_giaGoc" value="{{ old('sp_giaGoc') }}">
    </div>
    <div class="form-group">
        <label for="sp_giaBan">Giá bán</label>
        <input type="text" class="form-control" name="sp_giaBan" id="sp_giaBan" value="{{ old('sp_giaBan') }}">
    </div>
    <!-- <div class="form-group">
        <label for="sp_hinh">Hình</label>
        <input type="text" class="form-control" name="sp_hinh" id="sp_hinh" value="{{ old('sp_hinh') }}">
    </div> -->
    <div class="form-group">
        <label for="sp_thongTin">Thông tin</label>
        <input type="text" class="form-control" name="sp_thongTin" id="sp_thongTin" value="{{ old('sp_thongTin') }}">
    </div>
    <div class="form-group">
        <label for="sp_danhGia">Đánh giá</label>
        <input type="text" class="form-control" name="sp_danhGia" id="sp_danhGia" value="{{ old('sp_danhGia') }}">
    </div>
    <div class="form-group">
        <label for="sp_trangThai">Trạng thái</label>
        <select class="form-control" name="sp_trangThai" id="sp_trangThai">
            <option value="1" {{ old('sp_trangThai') == 1 ?'selected' :'' }}>Khóa</option>
            <option value="2" {{ old('sp_trangThai') == 2 ?'selected' :'' }}>Khả dụng</option>
        </select>
    </div>
    <div class="form-group">
        <label for="l_ma"></label>
        <select class="form-control" name="l_ma" id="l_ma">
            @foreach($dsLoai as $loai)
            <option value="{{ $loai->l_ma }}">{{ $loai->l_ten }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <div class="file-loading">
            <label for="sp_hinh">Hình</label>
            <input type="file" name="sp_hinh" id="sp_hinh">
        </div>
    </div>
    <button type="submit" class="btn btn-success">Lưu</button>
</form>
@endsection

@section('custom-scripts')
<!-- SCRIPTS dành cho thư viện bootstrap-fileinput -->
<script src="{{ asset('vendor/bootstrap-fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/js/locales/fr.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fas/theme.js') }}" type="text/javascript"></script>

<script>
$(function() {
    $("#sp_hinh").fileinput({
        theme: 'fas',
        showUpload: false,
        showCaption: false,
        browseClass: "btn btn-primary btn-lg",
        fileType: "any",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        overwriteInitial: false
    });
});
</script>
@endsection