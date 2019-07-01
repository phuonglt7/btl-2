@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Xác thực tài khoản') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Trước khi thực hiện, Bạn hãy kiểm tra email của bạn để xác thực tài khoản này.') }}
                    {{ __('Nếu không tìm thấy Email của chúng tôi') }}, <a href="{{ route('verification.resend') }}">{{ __('Nhấp vào đây') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
