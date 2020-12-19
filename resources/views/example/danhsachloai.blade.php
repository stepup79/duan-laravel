<h1>Danh sách table Loại</h1>
<table border="1" width=100%>
    <thead>
        <th>Mã</th>
        <th>Tên</th>
        <th>Tạo mới</th>
        <th>Cập nhật</th>
        <th>Trạng thái</th>
        <th>SL Loại</th>
    </thead>
    <tbody>
        <!-- Duyệt vòng lặp - start-->
        @foreach($dataLoai as $loai)
        <tr>
            <td>{{ $loai->l_ma }}</td>
            <td>{{ $loai->l_ten }}</td>
            <td>{{ $loai->l_taoMoi }}</td>
            <td>{{ $loai->l_capNhat }}</td>
            <td>
                <?php
                $tentrangthai = '';
                if($loai->l_trangThai == 1) {
                    $tentrangthai = 'Khóa';
                } else if ($loai->l_trangThai == 2) {
                    $tentrangthai = 'Khả dụng';
                }
                ?>
                {{ $tentrangthai }}
            </td>
            <td>{{ $loai->sanPhams->count() }}</td>
        </tr>
        @endforeach
        <!-- Duyệt vòng lặp - end-->
    </tbody>
</table>