@extends('backend.layouts.master')

@section('title')
Đây là trang index Sản Phẩm
@endsection

@section('custom-css')
<style>
    .img-detail {
        width: 100px;
        height: 120px;
    }
</style>
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

<!-- Tạo nút Thêm mới sản phẩm 
- Theo quy ước, các route đã được đăng ký trong file `web.php` đều phải được đặt tên để dễ dàng bảo trì code sau này.
- Đường dẫn URL là đường dẫn được tạo ra bằng route có tên `admin.sanpham.create`
- Sẽ có dạng http://tenmiencuaban.com/admin/danhsachsanpham/create
-->
<a class="btn btn-primary" href="{{ route('admin.sanpham.create') }}">Thêm mới</a>
<!-- Tạo nút xem biểu mẫu khi in trên web -->
<a class="btn btn-outline-primary" href="{{ route('admin.sanpham.print') }}">In ấn</a>
<!-- Tạo nút xuất ra bản in file Excel trên web -->
<a class="btn btn-outline-success" href="{{ route('admin.sanpham.excel') }}">In Excel</a>
<!-- Tạo table hiển thị danh sách các sản phẩm -->
<table class="table table-striped">
    <tr>
        <th>Mã sản phẩm</th>
        <th>Tên</th>
        <th>Giá sản phẩm</th>
        <th>Hình</th>
        <th>Thông tin</th>
        <th>Trạng thái</th>
        <th>Loại sản phẩm</th>
        <th>Chức năng</th>
    </tr>
    <!-- Sử dụng vòng lặp foreach để duyệt qua các sản phẩm 
    - Biến $dsSanPham là biến được truyền qua từ action `index()` trong controller SanPhamController.
    -->
    @foreach($dsSanPham as $sp)
    <tr>
        <td>{{ $sp->sp_ma }}</td>
        <td>{{ $sp->sp_ten }}</td>
        <td>{{ $sp->sp_giaGoc }}</td>
        <td>
            <!-- Lấy đường dẫn file ánh xạ + tên hình -->
            <img src="{{ asset('storage/photos/' . $sp->sp_hinh) }}" class="img-detail"/>
        </td>
        <td>{{ $sp->sp_thongTin }}</td>
        <td>{{ $sp->sp_trangThai }}</td>
        <td>{{ $sp->loaiSanpham->l_ten }}</td>
        <td>
            <!-- Tạo nút Sửa sản phẩm 
            - Theo quy ước, các route đã được đăng ký trong file `web.php` đều phải được đặt tên để dễ dàng bảo trì code sau này.
            - Đường dẫn URL là đường dẫn được tạo ra bằng route có tên `admin.sanpham.edit`
            - Route `admin.sanpham.edit` cần truyền vào 1 tham số {id}. Giá trị cần truyền là {id} của sản phẩm người dùng cần hiệu chỉnh.
            - Các tham số cần truyền vào hàm route() là 1 array[]
            - Sẽ có dạng http://tenmiencuaban.com/admin/danhsachsanpham/{id}/edit
            -->
            <a href="{{ route('admin.sanpham.edit', ['id' => $sp->sp_ma]) }}" class="btn btn-warning pull-left">Sửa</a>

            <!-- Tạo nút Xóa sản phẩm 
            - Theo quy ước, các route đã được đăng ký trong file `web.php` đều phải được đặt tên để dễ dàng bảo trì code sau này.
            - Đường dẫn URL là đường dẫn được tạo ra bằng route có tên `admin.sanpham.destroy`
            - Route `admin.sanpham.destroy` cần truyền vào 1 tham số {id}. Giá trị cần truyền là {id} của sản phẩm người dùng cần xóa.
            - Các tham số cần truyền vào hàm route() là 1 array[]
            - Sẽ có dạng http://tenmiencuaban.com/admin/danhsachsanpham/{id}
            -->
            <form method="post" action="{{ route('admin.sanpham.destroy', ['id' => $sp->sp_ma]) }}" class="pull-left">
            <!-- Khi gởi Request Xóa dữ liệu, Laravel Framework mặc định chỉ chấp nhận thực thi nếu có gởi kèm field `_method=DELETE` -->
            <input type="hidden" name="_method" value="DELETE" />
            <!-- Khi gởi bất kỳ Request POST, Laravel Framework mặc định cần có token để chống lỗi bảo mật CSRF 
            - Bạn có thể tắt đi, nhưng lời khuyên là không nên tắt chế độ bảo mật CSRF đi.
            - Thay vào đó, sử dụng hàm `csrf_field()` để tự sinh ra 1 input có token dành riêng cho CSRF
            -->
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection