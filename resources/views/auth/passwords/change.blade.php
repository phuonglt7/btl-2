@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                @include('layouts.announce')
                <div class="card-body">
                    <form method="POST" action="{{ route('postchangepass') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu cũ:') }}</label>
                            <div class="col-md-6">
                                <input id="password_old" type="password" name="password_old" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu mới:') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" name="password" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nhập lại mất khẩu mới:') }}</label>
                            <div class="col-md-6">
                                <input id="password_confirm" type="password" name="password_confirm" >
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Đổi mật khẩu') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection