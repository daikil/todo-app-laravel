<!--
*   extends：親ビューを継承する（読み込む）
*   親ビュー名：layout を指定
-->
@extends('layout')

<!--
*   section：子ビューにsectionでデータを定義する
*   セクション名：content を指定
*   用途：ログインページを表示する
-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">ログイン</div>
                    <div class="card-body">
                        <!-- エラーメッセージを表示する -->
                        <!-- エラーがある場合はIF文の処理を実行する -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    <!-- エラーメッセージをループで全て列挙して表示する -->
                                    @foreach($errors->all() as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            <!-- セキュリティ対策：@csrf は、CSRFトークンを含んだ input 要素を出力します -->
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス</label>
                                <!--
                                *   入力値を復元する
                                *   old()：セッション値を取得する関数（この場合は入力されたタイトルをセッションとして扱う）
                                -->
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">パスワード</label>
                                <input type="password" class="form-control" id="password" name="password" />
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">送信</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}">パスワードの変更はこちらから</a>
                </div>
            </div>
        </div>
    </div>
@endsection
