@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card">
                <div class="card-header">{{ __('Chuyển tiền') }}</div>

                @include('layouts.announce')
                <div class="card-body">
                    <form method="POST" action="{{ route('transfer.store') }}" onsubmit="return ConfirmTransfor();">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Nội dung:') }}</label>
                            <div class="col-md-6">
                                <input id="content" type="text" name="content"  >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Số tiền:') }}</label>
                            <div class="col-md-6">
                                <input id="value" type="text" name="value" onkeyup="valid(this,'numbers')"> VND
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-md-4 col-form-label text-md-right">{{ __('Tài khoản nhận:') }}</label>
                            <div class="col-md-6">
                                <select name="wallet_receive">
                                    <option value="" checked > -- Lựa chọn --</option>

                                    @foreach($wallet as $wallet_name)
                                        <option value="{{ $wallet_name->wallet_name }}"> {{ $wallet_name->wallet_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" >
                                    {{ __(' Chuyển khoản') }}
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