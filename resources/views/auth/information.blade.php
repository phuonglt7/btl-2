@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Thông tin các nhân') }}</div>
                <div class="card-body">

                    @include('layouts.announce')
                    <form method="POST" action="{{ route('postInformation') }}">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Họ tên') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" name="name" value="{{ $user->name }}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Email:') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" name="email" value="{{ $user->email }}" readonly >
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn-primary">
                                    {{ __('Sửa thông tin') }}
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