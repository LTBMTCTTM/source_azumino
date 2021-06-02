<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title><?= APP_NAME?> |  Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</head>
<body class="hold-transition">

<div class="bg-white login-page container">
    <div class="login-box">
        <div class="login-logo text-nowrap">
            <img src="{{ asset('/images/logo.png') }}" alt="The Logo" class="brand-image"
                 style="opacity: .8">
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control"
                               name="admin_id" placeholder="ログインID"
                               id="username"
                               value="{{ old('admin_id') }}" autofocus>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" placeholder="パスワード"
                               class="form-control" name="password"
                               autocomplete="current-password"/>

                    </div>
                    <div class="row">
                        @if(!$errors->has('password'))
                        <p class="login-box-msg">ユーザ名とパスワードを入力してください。</p>
                        @endif
                        @error('password')
                        <p class="login-box-msg text-red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-center mb-3">
                        <button class="btn btn-block btn-primary">ログイン</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

</html>
