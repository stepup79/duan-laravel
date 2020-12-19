<h1>Danh sách table Sản phẩm</h1>
<table border="1" width=100%>
    <thead>
        <th>Mã</th>
        <th>Tên</th>
        <th>Tạo mới</th>
        <th>Cập nhật</th>
        <th>Trạng thái</th>
        <th>Loại sản phẩm</th>
    </thead>
    <tbody>
        <!-- Duyệt vòng lặp - start-->
        @foreach($dataSanpham as $sanpham)
        <tr>
            <td>{{ $sanpham->sp_ma }}</td>
            <td>{{ $sanpham->sp_ten }}</td>
            <td>{{ $sanpham->sp_taoMoi }}</td>
            <td>{{ $sanpham->sp_capNhat }}</td>
            <td>
                <?php
                $tentrangthai = '';
                if($sanpham->sp_trangThai == 1) {
                    $tentrangthai = 'Khóa';
                } else if ($sanpham->sp_trangThai == 2) {
                    $tentrangthai = 'Khả dụng';
                }
                ?>
                {{ $tentrangthai }}
            </td>
            <td>{{ $sanpham->loaiSanpham->l_ten }}</td>
        </tr>
        @endforeach
        <!-- Duyệt vòng lặp - end-->
    </tbody>
</table>