@extends('layouts.app')

@section('content')
<div class="app">
    <div class="col-sm-10">
        <div class="card-header"><h2>{{ __('Danh sách Ví') }}</h2></div>
        <p><button type="button" class="btn-success"><a href="{{ route('wallet.create') }}">Thêm Ví</a></button></p>

        @include('layouts.announce')
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> Tên Ví </th>
                    <th> Số tiền </th>
                    <th width="200px"> Thực hiện </th>
                </tr>
            </thead>
            <tbody>

                @foreach($wallets as $wallet)
                <tr>
                    <td>{{ $wallet->wallet_name }}</td>
                    <td>{{ number_format($wallet->coin) }} VND</td>
                    <td>
                        <div class="row">
                            <a href="{{ route('wallet.edit', $wallet->id) }}"><button class="btn-success" style="margin:0px 20px 0px 40px">Sửa</button></a>
                            <form action="{{ route('wallet.destroy',['id' => $wallet->id]) }}" class="submitDelete" method="post" onsubmit="return ConfirmDelete();" >
                                {!! csrf_field() !!}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn-danger">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
@endsection


