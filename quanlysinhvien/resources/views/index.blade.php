@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Quản lý sinh viên</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('sinhvien.create')}}" class="btn btn-primary float-end">Thêm mới</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(Session::has('thongbao'))
                    <div class="alert alert-success">
                        {{Session::get('thongbao')}}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã sinh viên</th>
                            <th>Họ tên</th>
                            <th>Ngày Sinh</th>
                            <th>Giới tính</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sinhvien as $sv)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$sv->MaSV}}</td>
                            <td>{{$sv->HoTen}}</td>
                            <td>{{$sv->NgaySinh}}</td>
                            <td>{{$sv->GioiTinh}}</td>
                            <td>{{$sv->DiaChi}}</td>
                            <td>{{$sv->SoDT}}</td>
                            <td>
                                <form action="{{route('sinhvien.destroy', $sv->id)}}" method="POST">
                                    <a href="{{route('sinhvien.edit', $sv->id)}}" class="btn btn-info">Sửa</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{$sinhvien->links()}}
        </div>
    </div>
@endsection