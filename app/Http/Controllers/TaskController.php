<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Folder;
// タスククラスを名前空間でインポートする
use App\Models\Task;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     *  【タスク作成ページの表示機能】
     *
     *  GET /folders/{id}/tasks/create
     *  @param int $id
     *  @return View
     */
    public function showCreateForm(int $id): View
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    /**
     *  【タスクの作成機能】
     *
     *  POST /folders/{id}/tasks/create
     *  @param int $id
     *  @param CreateTask $request
     *  @return RedirectResponse
     */
    public function create(int $id, CreateTask $request): RedirectResponse
    {
        /* ユーザーによって選択されたフォルダを取得する */
        // find()：一行分のデータを取得する関数
        $folder = Folder::find($id);

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
            'id' => $folder->id,
        ]);
    }

    /**
     *  【タスク一覧ページの表示機能】
     *
     *  GET /folders/{id}/tasks
     *  @param int $id
     *  @return View
     */
    public function index(int $id): View
    {
        /* Folderモデルの全てのデータをDBから取得する */
        // all()：全てのデータを取得する関数
        $folders = Folder::all();

        /* ユーザーによって選択されたフォルダを取得する */
        // find()：一行分のデータを取得する関数
        $folder = Folder::find($id);

        /* ユーザーによって選択されたフォルダに紐づくタスクを取得する */
        // where(カラム名,カラムに対して比較する値)：特定の条件を指定する関数 ※一致する場合の条件 `'='` を省略形で記述しています
        // get()：値を取得する関数（この場合はwhere関数で生成されたSQL文を発行して値を取得する）
        $tasks = $folder->tasks()->get();

        /* DBから取得した情報をViewに渡す */
        // view('遷移先のbladeファイル名', [連想配列：渡したい変数についての情報]);
        // 連想配列：['キー（テンプレート側で参照する際の変数名）' => '渡したい変数']
        return view('tasks/index', [
            'folders' => $folders,
            'folder_id' => $folder->id,
            'tasks' => $tasks
        ]);
    }
}
