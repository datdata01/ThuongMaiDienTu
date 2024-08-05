@extends('users.layouts.default')

@section('content')
<div class="container">
    <h2>Đăng Ký</h2>

    @if(session('messageSuccess'))
        <div class="alert alert-success">
            {{ session('messageSuccess') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('postRegister') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Tên:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Đăng Ký</button>
    </form>
</div>
@endsection
