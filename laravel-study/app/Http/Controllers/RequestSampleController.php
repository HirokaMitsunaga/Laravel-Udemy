<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestSampleController extends Controller {
    public function form() {
        return view('form');
    }

    public function queryStrings(Request $request) {
        $keyword = $request->get('keyword', '未設定');
        return 'キーワードは' . $keyword . 'です';
    }

    public function profile($id) {
        return 'ID: ' . $id;
    }

    public function productArcive(Request $request, $category, $year) {
        return 'category:' .
            $category .
            '<br>year:' .
            $year .
            '<br>page:' .
            $request->get(key: 'page', default: 1);
    }

    public function loginForm() {
        return view('login');
    }

    public function routeLink() {
        $url = route(
            name: 'profile',
            parameters: ['id' => 1, 'phptos' => 'yes']
        );
        return 'プロフィールページのURLは' . $url . 'です';
    }

    public function login(Request $request) {
        if (
            $request->get('email') === 'user@example.com' &&
            $request->get('password') === '12345678'
        ) {
            return 'ログイン成功';
        }
        return 'ログイン失敗';
    }
}
