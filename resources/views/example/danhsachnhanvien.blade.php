@extends('layouts.master')

@section('title')
Danh sách nhân viên
@endsection

@section('content')
    <h1>Danh sách nhân viên công ty</h1>
    <table border="1" cellspacing="0" width="100%">
        <thead>
            <th>id</th>
            <th>first_name</th>
            <th>last_name</th>
            <th>email</th>
            <th>gender</th>
            <th>ip_address</th>
        </thead>
        <tbody>
            <!-- Duyệt vòng lặp, in ra danh sách nhân viên - start-->
            @foreach($dsnhanvien_view as $nhanvien)
            <tr>
                <td>{{ $nhanvien->id }}</td>
                <td>{{ $nhanvien->first_name }}</td>
                <td>{{ $nhanvien->last_name }}</td>
                <td>{{ $nhanvien->email }}</td>
                <td>{{ $nhanvien->gender }}</td>
                <td>{{ $nhanvien->ip_address }}</td>
            </tr>
            @endforeach
            <!-- Duyệt vòng lặp, in ra danh sách nhân viên - end-->
        </tbody>
    </table>
@endsection