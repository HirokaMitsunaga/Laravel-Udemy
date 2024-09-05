<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller {
    //登録画面表示
    public function create() {
        return view('events.create');
    }

    //登録処理
    public function store(Request $request) {
        $title = $request->get('title');
        Log::debug('イベント名:' . $title);
        return to_route('events.create')->with(
            'success',
            $title . 'を登録しました'
        );
    }
}
