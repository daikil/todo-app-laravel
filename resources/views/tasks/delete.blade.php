<!--
*   extends：親ビューを継承する（読み込む）
*   親ビュー名：layout を指定
-->
@extends('layout')

<!--
*   section：子ビューにsectionでデータを定義する
*   セクション名：content を指定
*   用途：タスクを削除するページのHTMLを表示する
-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">タスクを削除する</div>
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
                        <form action="{{ route('tasks.delete', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">タイトル</label>
                                <input type="text" class="form-control" name="title" id="title"
                                       value="{{ old('title') ?? $task->title }}"
                                       disabled />
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">状態</label>
                                <select name="status" id="status" class="form-select" disabled>
                                    @foreach(\App\Models\Task::STATUS as $key => $val)
                                        <option value="{{ $key }}" {{ $key == old('status', $task->status) ? 'selected' : '' }}>
                                            {{ $val['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="due_date" class="form-label">期限</label>
                                <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') ?? $task->formatted_due_date }}" disabled />
                            </div>
                            <p>上記の項目を削除しようとしています。本当によろしいでしょうか？</p>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary" onclick="window.location='{{ route('tasks.index', ['id' => $task->folder_id]) }}'">キャンセル</button>
                                <button type="submit" class="btn btn-danger">削除</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
