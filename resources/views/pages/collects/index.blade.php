@extends('layouts.app')

@section('content')
<div class="app">
    <div class="col-sm-10">
        <h2>Danh sách Thu</h2>
        <p>
            <button type="button" class="btn-success"><a href="{{ route('collect.create') }}">Thêm Thu nhập</a></button>
            @if ($count > 0)
            <div class="export">
                <a href ="{{ route('exportCollect') }}"><button  class="btn-info export" id="export-button">Export file</button> </a>
            </div>
            @endif
        </p>
        @include('layouts.announce')
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> STT </th>
                    <th> Nội dung </th>
                    <th> Số tiền thu </th>
                    <th> Thời gian </th>
                </tr>
            </thead>
            <tbody>
                <div style="display:none;">{{ $i=1 }}</div>
                @foreach($collects as $collect)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $collect->content }}</td>
                    <td>{{ $collect->value }}</td>
                    <td>{{ $collect->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
         {{ $collects->links() }}
    </div>
  </div>
@endsection


