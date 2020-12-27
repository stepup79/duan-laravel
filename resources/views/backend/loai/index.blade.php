@extends('backend.layouts.master')

@section('title')
Đây là trang index Loại
@endsection

@section('content')
<!-- Đây là div hiển thị Kết quả (thành công, thất bại) sau khi thực hiện các chức năng Thêm, Sửa, Xóa.
- Div này chỉ hiển thị khi trong Session có các key `alert-*` từ Controller trả về. 
- Sử dụng các class của Bootstrap "danger", "warning", "success", "info" để hiển thị màu cho đúng với trạng thái kết quả.
-->
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
</div>

<!-- Tạo nút Thêm mới loại sản phẩm 
- Theo quy ước, các route đã được đăng ký trong file `web.php` đều phải được đặt tên để dễ dàng bảo trì code sau này.
- Đường dẫn URL là đường dẫn được tạo ra bằng route có tên `loai.create`
- Sẽ có dạng http://tenmiencuaban.com/admin/loai/create
-->
<a href="{{ route('admin.loai.create') }}" class="btn btn-primary">Thêm mới</a>
<!-- Tạo nút xuất ra bản in file PDF trên web -->
<a class="btn btn-outline-danger" href="{{ route('admin.loai.pdf') }}">In PDF</a>

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
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection