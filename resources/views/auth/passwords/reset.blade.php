<!--
*   extends()：親ビューを継承する（読み込む）
*   親ビュー名：layout を指定
-->
@extends('layout')

<!--
*   section()：子ビューにsectionでデータを定義する
*   セクション名：content を指定
*   用途：パスワード再設定ページを表示する
-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">パスワード再発行</div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}" />
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">新しいパスワード</label>
                                <input type="password" class="form-control" id="password" name="password" />
                            </div>
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">新しいパスワード（確認）</label>
                                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" />
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">送信</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
