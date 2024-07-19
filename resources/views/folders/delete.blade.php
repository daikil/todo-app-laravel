<!--
*   extends：親ビューを継承する（読み込む）
*   親ビュー名：layout を指定
-->
@extends('layout')

<!--
*   section：子ビューにsectionでデータを定義する
*   セクション名：content を指定
*   用途：フォルダを削除するページのHTMLを表示する
-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">フォルダを削除する</div>
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
                        <form action="{{ route('folders.delete', ['id' => $folder_id]) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">フォルダ名</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $folder_title }}" disabled />
                            </div>
                            <p>上記の項目を削除しようとしています。本当によろしいでしょうか？</p>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('tasks.index', ['id' => $folder_id]) }}'">キャンセル</button>
                                <button type="submit" class="btn btn-danger">削除</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
