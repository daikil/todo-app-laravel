<!--
*   extends：親ビューを継承する（読み込む）
*   親ビュー名：layout を指定
-->
@extends('layout')

<!--
*   section：子ビューにsectionでデータを定義する
*   セクション名：content を指定
*   用途：ホームページをHTMLで表示する
-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        まずはフォルダを作成しましょう
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <a href="{{ route('folders.create') }}" class="btn btn-primary">
                                フォルダ作成ページへ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
