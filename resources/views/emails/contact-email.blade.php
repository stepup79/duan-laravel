<!-- Nội dung template chỉ nên sử dụng HTML cơ bản (TABLE, CSS INLINE,...) -->
<table border="1">
    <tr>
        <td>LOGO</td>
        <td>COMPANY</td>
    </tr>
    <tr>
        <td>
            Email khách vừa liên hệ: {{ $data['email'] }}
        </td>
        <td>
            Lời nhắn: {{ $data['message'] }}
        </td>
    </tr>
</table>