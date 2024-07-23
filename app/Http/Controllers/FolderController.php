<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Folder;
use App\Http\Requests\CreateFolder;
use App\Http\Requests\EditFolder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    /**
     *  【フォルダ作成ページの表示機能】
     *
     *  GET /folders/create
     *  @return View
     */
    public function showCreateForm(): View
    {
        /* フォルダの新規作成ページを呼び出す */
        // view('遷移先のbladeファイル名');
        return view('folders.create');
    }

    /**
     *  【フォルダの作成機能】
     *
     *  POST /folders/create
     *  @param CreateFolder $request （Requestクラスの機能は引き継がれる）
     *  @return RedirectResponse
     */
    public function create(CreateFolder $request): RedirectResponse
    {
        /* 新規作成のフォルダー名（タイトル）をDBに書き込む処理 */
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;
        // （ログイン）ユーザーに紐づけて保存する
        Auth::user()->folders()->save($folder);

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
     *  【フォルダ編集ページの表示機能】
     *
     *  GET /folders/{folder}/edit
     *  @param Folder $folder
     *  @return View
     */
    public function showEditForm(Folder $folder): View
    {
        $folder = Auth::user()->folders()->findOrFail($folder->id);
        return view('folders.edit', [
            'folder_id' => $folder->id,
            'folder_title' => $folder->title,
        ]);
    }

    /**
     *  【フォルダの編集機能】
     *
     *  POST /folders/{folder}/edit
     *  @param Folder $folder
     *  @param EditFolder $request
     *  @return RedirectResponse
     */
    public function edit(Folder $folder, EditFolder $request): RedirectResponse
    {
        $folder = Auth::user()->folders()->findOrFail($folder->id);

        $folder->title = $request->title;
        $folder->save();

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }

    /**
     *  【フォルダ削除ページの表示機能】
     *  機能：フォルダIDをフォルダ編集ページに渡して表示する
     *
     *  GET /folders/{folder}/delete
     *  @param Folder $folder
     *  @return View
     */
    public function showDeleteForm(Folder $folder): View
    {
        $folder = Auth::user()->folders()->findOrFail($folder->id);

        return view('folders/delete', [
            'folder_id' => $folder->id,
            'folder_title' => $folder->title,
        ]);
    }

    /**
     *  【フォルダの削除機能】
     *  機能：フォルダが削除されたらDBから削除し、フォルダ一覧にリダイレクトする
     *
     *  POST /folders/{folder}/delete
     *  @param Folder $folder
     *  @return RedirectResponse
     */
    public function delete(Folder $folder): RedirectResponse
    {
        $folder = Auth::user()->folders()->findOrFail($folder->id);

        $folder->tasks()->delete();
        $folder->delete();

        $folder = Folder::first();

        return redirect()->route('tasks.index', [
            'folder' => $folder->id
        ]);
    }
}

