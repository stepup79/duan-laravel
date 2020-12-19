@extends('backend.layouts.master')

@section('title')
Đây là trang test layout Backend
@endsection

@section('custom-css')
<style>
h2 {
    color:red;
}
</style>
@endsection

@section('content')
<h2>Xin chào Backend</h2>
@endsection

@section('custom-scripts')
<script>
alert('Hello');
</script>
@endsection