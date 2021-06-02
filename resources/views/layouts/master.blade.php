<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('js/app.js?v='.strtotime(date(TIME_FORMAT))) }}"></script>
    <script type="text/javascript" src="{{ asset('js/common.js?v='.strtotime(date(TIME_FORMAT))) }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('dist/jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <script type="text/javascript" src="{{ asset('dist/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>

    <script src="{{asset('dist/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('dist/select2/dist/css/select2.min.css')}}">

    <script>
        $( function() {
            $( ".datepicker" ).datepicker({dateFormat: 'yy/mm/dd'});
        } );
    </script>
    <script>
        $(function () {
            //$('#work-date-from').datepicker({dateFormat: 'yy/mm/dd',currentText: "Now"});
            $('.select2').select2({});
            $('.select2-not-search').select2({ minimumResultsForSearch: -1});
            $('.select2-full-width').select2({ width: '100%'});
        });
    </script>
</head>

<body class="hold-transition">
@include("components.progress_bar")
<div class="wrapper">
    @yield('head')
    @yield('left')
    <div class="content-wrapper">
        @yield('content')
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
    </footer>
</div>
@yield('end-javascript')
<div class="modal fade" id="modal-change-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header az-bg-primary">
                <div class="col-1"></div>
                <div class="col-10 text-center">
                    <span class="modal-title font-weight-bold text-white">パスワード変更</span>
                </div>
                <div class="col-1 ms-3">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form id="form-change-password" method="POST" action="{{ route('change.password') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="current-password" class="col-sm-5 col-form-label">現在のパスワード</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="current_password"
                                       id="current-password" required>
                                <small id="current_password-validator" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new-password" class="col-sm-5 col-form-label">新しいパスワード</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="new_password" id="new-password"
                                       required>
                                <small id="new_password-validator" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_confirm_password" class="col-sm-5 col-form-label">確認のパスワード</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="new_confirm_password"
                                       id="new_confirm_password" required>
                            </div>
                        </div>
                        <div class="form-group text-center m-0">
                            <p class="text-red text-bold m-0" id="change-password-validator">&nbsp;</p>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer d-block">
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-center mb-2">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">キャンセル</button>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center mb-2">
                        <button type="button" class="btn btn-primary az-bg-primary btn-block" onclick="changePassword()">変更</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</body>

</html>
