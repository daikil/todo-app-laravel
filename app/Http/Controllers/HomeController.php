<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *  ホームページを表示する
     *  GET /
     * @return RedirectResponse | View
     */
    public function index(): RedirectResponse | View
    {
        try {
            $folder = Auth::user()->folders()->first();

            if (is_null($folder)) {
                return view('home');
            }

            return redirect()->route('tasks.index', [
                'folder' => $folder->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error HomeController in index: ' . $e->getMessage());
            return redirect()->route('home')->withErrors('エラーが発生しました。');
        }
    }
}
