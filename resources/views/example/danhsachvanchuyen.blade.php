<h1>Danh sách table Vận chuyển</h1>
<table border="1" width=100%>
    <thead>
        <th>Mã</th>
        <th>Tên</th>
        <th>Chi phí</th>
        <th>Diễn giải</th>
        <th>Tạo mới</th>
        <th>Cập nhật</th>
        <th>Trạng thái</th>
        <th>SL Đơn hàng</th>
    </thead>
    <tbody>
        <!-- Duyệt vòng lặp - start-->
        @foreach($dataVanchuyen as $vanchuyen)
        <tr>
            <td>{{ $vanchuyen->vc_ma }}</td>
            <td>{{ $vanchuyen->vc_ten }}</td>
            <td>{{ $vanchuyen->vc_chiPhi }}</td>
            <td>{{ $vanchuyen->vc_dienGiai }}</td>
            <td>{{ $vanchuyen->vc_taoMoi }}</td>
            <td>{{ $vanchuyen->vc_capNhat }}</td>
            <td>{{ $vanchuyen->vc_trangThai }}</td>
            <td>{{ $vanchuyen->donHangs->count() }}</td>
        </tr>
        @endforeach
        <!-- Duyệt vòng lặp - end-->
    </tbody>
</table>