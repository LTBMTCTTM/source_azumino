@extends('layouts.master')
@section('title',APP_NAME. ' | 作業員一覧')
@section('head')
    @include('layouts.head')
@endsection
@section('left')
    @include('workers.left')
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <h4 class="font-weight-bold text-center">作業員一覧</h4>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <button type="button" class="btn az-bg-primary" onclick="jQuery.Workers.func_detail(this, true)">新規登録</button>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="table-workers" class="table table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">作業員コード</th>
                            <th class="text-center">作業員名</th>
                            <th class="text-center">所属倉庫・工場</th>
                            <th class="text-center">無効状態</th>
                            <th class="text-center">詳細</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $idx => $row)
                            <tr id="{{$row->worker_id}}">
                                <td class="text-center">{{$row->worker_id}}</td>
                                <td class="text-left">{{$row->worker_name}}</td>
                                <td class="text-left"> {{ $row->store_name }} </td>
                                @if($row->disabled_flag ==0)
                                    <td class="text-center">-</td>
                                @else
                                    <td class="text-center text-red">無効</td>
                                @endif
                                <td class="text-center">
                                    <button class="btn az-bg-primary" id="{{$row->worker_id}}"
                                            onclick="jQuery.Workers.func_detail(this, false)">詳細
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12" id="paginator">
                    {!! paginator($currentPage , PAGE_LIMITS, $total, "jQuery.Workers.func_paging(this)") !!}
                </div>
            </div>
        </div>
    </section>
    @include('workers.modal-detail')
@endsection
@section('end-javascript')
    <script type="text/javascript"
            src="{{ asset('js/workers.js?v='.strtotime(date(TIME_FORMAT))) }}"></script>
@endsection
