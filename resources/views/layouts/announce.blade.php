@if (count($errors) > 0)
    <div class="alert alert-danger">
        Thông tin đăng ký không đầy đủ, bạn cần chỉnh sửa như sau:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif