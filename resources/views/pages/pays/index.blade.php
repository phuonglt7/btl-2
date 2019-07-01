@extends('layouts.app')

@section('content')
<div class="app">
    <div class="col-sm-10">
        <h2>Danh sách Chi</h2>
        <p>
        <a href="{{ route('pay.create') }}"><button class="btn-success">Thêm Chi Tiêu</button></a>
        @if ($count > 0)
        <div class="export">
            <a href ="{{ route('exportPay') }}"><button  class="btn-info export" id="export-button">Export file</button></a>
        </div>
        @endif
        </p>

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
                <div style="display:none;">{{ $i=1 }}</div>

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
        {{ $pays->links() }}
    </div>
  </div>
@endsection


