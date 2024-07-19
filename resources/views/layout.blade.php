<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo App</title>
    <!--
    *   yield()：子ビューで定義したデータを表示する
    *   セクション名：styles を指定
    *   用途：javascriptライブラリー「flatpickr」のスタイルシートを指定
    -->
    @yield('styles')
    @vite(['resources/css/styles.css', 'resources/js/app.js'])
</head>
<body>
<header>
    <nav class="my-navbar">
        <a class="my-navbar-brand" href="/">ToDo App</a>
        <div class="my-navbar-control">
            <!-- ログインユーザーの取得 -->
            <!-- Auth::check() :ログイン状態を確認する関数（ログイン状態でtrueを返す） -->
            @if(Auth::check())
                <!-- ログイン時にユーザー名を表示する -->
                <span class="my-navbar-item">ようこそ, {{ Auth::user()->name }}さん</span>
                ｜
                <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
                <!-- ログアウトがクリックされた時にイベントスクリプトと処理を呼び出す -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    <!-- セキュリティ対策：@csrf は、CSRFトークンを含んだ input 要素を出力します -->
                    @csrf
                </form>
            @else
                <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
                ｜
                <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
            @endif
        </div>
    </nav>
</header>
<main>
    <!--
    *   yield()：子ビューで定義したデータを表示する
    *   セクション名：content を指定
    *   用途：タスクを追加するHTMLを表示する
    -->
    @yield('content')
</main>
<!--
    *   ログアウトのクリックイベント
    *   機能：ログアウトリンクのクリック時に真下のログアウトフォームを送信する
    *   用途：ログアウトを実施する
    -->
@if(Auth::check())
    <script>
        // ログアウトがクリックされたらイベントを実施する
        document.getElementById('logout').addEventListener('click', function(event) {
            // 現在のURLにフォームの内容を送信するデフォルトの処理をキャンセルする（イベントを中断するリロードのキャンセル）
            event.preventDefault();
            // ログアウトフォームの内容を送信する
            document.getElementById('logout-form').submit();
        });
    </script>
@endif
@yield('scripts')
</body>
</html>
