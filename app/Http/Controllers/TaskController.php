<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Folder;
// タスククラスを名前空間でインポートする
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     *  【タスク作成ページの表示機能】
     *
     *  GET /folders/{folder}/tasks/create
     *  @param Folder $folder
     *  @return View
     */
    public function showCreateForm(Folder $folder): View
    {
        $folder = Auth::user()->folders()->findOrFail($folder->id);
        return view('tasks.create', [
            'folder_id' => $folder->id
        ]);
    }

    /**
     *  【タスクの作成機能】
     *
     *  POST /folders/{folder}/tasks/create
     *  @param Folder $folder
     *  @param CreateTask $request
     *  @return RedirectResponse
     */
    public function create(Folder $folder, CreateTask $request): RedirectResponse
    {
        /* ユーザーによって選択されたフォルダを取得する */
        $folder = Auth::user()->folders()->findOrFail($folder->id);

        /* 新規作成のタスク（タイトル）をDBに書き込む処理 */
        // タスクモデルのインスタンスを作成する
        $task = new Task();
        // タイトルに入力値を代入する
        $task->title = $request->title;
        // 期限に入力値を代入する
        $task->due_date = $request->due_date;
        // $folderに紐づくタスクを生成する（インスタンスの状態をデータベースに書き込む）
        $folder->tasks()->save($task);

        /* タスク一覧ページにリダイレクトする */
        // リダイレクト：別URLへの転送（リクエストされたURLとは別のURLに直ちに再リクエストさせます）
        // route('遷移先のbladeファイル名', [連想配列：渡したい変数についての情報]);
        // 連想配列：['キー（テンプレート側で参照する際の変数名）' => '渡したい変数']
        // redirect():リダイレクトを実施する関数
        // route():ルートPathを指定する関数
        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    /**
     *  【タスク一覧ページの表示機能】
     *
     *  GET /folders/{folder}/tasks
     *  @param Folder $folder
     *  @return View
     */
    public function index(Folder $folder): View
    {
        $user = auth()->user();
        $folders = $user->folders()->get();
        /* ユーザーによって選択されたフォルダに紐づくタスクを取得する */
        // where(カラム名,カラムに対して比較する値)：特定の条件を指定する関数 ※一致する場合の条件 `'='` を省略形で記述しています
        // get()：値を取得する関数（この場合はwhere関数で生成されたSQL文を発行して値を取得する）
        $tasks = $folder->tasks()->get();

        /* DBから取得した情報をViewに渡す */
        // view('遷移先のbladeファイル名', [連想配列：渡したい変数についての情報]);
        // 連想配列：['キー（テンプレート側で参照する際の変数名）' => '渡したい変数']
        return view('tasks.index', [
            'folders' => $folders,
            'folder_id' => $folder->id,
            'tasks' => $tasks
        ]);
    }

    /**
     *  【タスク編集ページの表示機能】
     *  機能：タスクIDをフォルダ編集ページに渡して表示する
     *
     *  GET /folders/{folder}/tasks/{task}/edit
     *  @param Folder $folder
     *  @param Task $task
     *  @return View
     */
    public function showEditForm(Folder $folder, Task $task): View
    {
        $folder = Auth::user()->folders()->findOrFail($folder->id);
        $task = $folder->tasks()->findOrFail($task->id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     *  【タスクの編集機能】
     *  機能：タスクが編集されたらDBを更新処理をしてタスク一覧にリダイレクトする
     *
     *  POST /folders/{folder}/tasks/{task}/edit
     *  @param Folder $folder
     *  @param Task $task
     *  @param EditTask $request
     *  @return RedirectResponse
     */
    public function edit(Folder $folder, Task $task, EditTask $request): RedirectResponse
    {
        $folder = Auth::user()->folders()->findOrFail($folder->id);
        $task = $folder->tasks()->findOrFail($task->id);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index', [
            'folder' => $task->folder_id,
        ]);
    }

    /**
     *  【タスク削除ページの表示機能】
     *
     *  GET /folders/{folder}/tasks/{task}/delete
     *  @param Folder $folder
     *  @param Task $task
     *  @return View
     */
    public function showDeleteForm(Folder $folder, Task $task): View
    {
        $folder = Auth::user()->folders()->findOrFail($folder->id);
        $task = $folder->tasks()->findOrFail($task->id);

        return view('tasks/delete', [
            'task' => $task,
        ]);
    }

    /**
     *  【タスクの削除機能】
     *
     *  POST /folders/{folder}/tasks/{task}/delete
     *  @param Folder $folder
     *  @param Task $task
     *  @return RedirectResponse
     */
    public function delete(Folder $folder, Task $task): RedirectResponse
    {
        $folder = Auth::user()->folders()->findOrFail($folder->id);
        $task = $folder->tasks()->findOrFail($task->id);

        $task->delete();

        return redirect()->route('tasks.index', [
            'folder' => $task->folder_id
        ]);
    }

}
