<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *  ホームページを表示する
     *  GET /
     * @return RedirectResponse | View
     */
    public function index(): RedirectResponse | View
    {
        $folder = Auth::user()->folders()->first();

        if (is_null($folder)) {
            return view('home');
        }

        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }
}
