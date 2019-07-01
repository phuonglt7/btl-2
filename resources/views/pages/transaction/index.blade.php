@extends('layouts.app')

@section('content')
<div class="app">
    <div class="col-sm-10">
        <div class="card-header"><h2>{{ __('Danh sách Chi tiêu') }}</h2></div>
        <p><button type="button" class="btn-success"><a href="{{ route('pay.create') }}">Thêm Chi Tiêu</a></button></p>

        @include('layouts.announce')
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> STT </th>
                    <th> Nội dung </th>
                    <th> Số tiền chi </th>
                    <th> Thời gian </th>
                </tr>
            </thead>
            <tbody>
                @foreach($pays as $pay)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $pay->content }}</td>
                    <td>{{ $pay->value }}</td>
                    <td>{{ $pay->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
@endsection


