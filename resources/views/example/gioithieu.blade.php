<?php
    $today = date ('d/m/Y H:i:s');
?>
<h1>Hôm nay ngày <?= $today ?></h1>
<ul style="color:red;">
    <li> Thông tin cá nhân </li>
    <li> Họ tên: {{ $hoten }}</li>
    <li> Địa chỉ: {{ $diachi }}</li>
</ul>