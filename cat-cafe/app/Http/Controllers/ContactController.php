<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAdminMail;

class ContactController extends Controller {
    public function index() {
        return view('contact.index');
    }

    function sendMail(ContactRequest $request) {
        $validated = $request->validated();

        Mail::to('hogehoge@gmail.com')->send(new ContactAdminMail($validated));
        // これ以降の行は入力エラーがなかった場合のみ実行されます
        // 登録処理(実際はメール送信などを行う)
        // Log::debug($validated['name']. 'さんよりお問い合わせがありました');

        return to_route('contact.complete');
    }
    public function complete() {
        return view('contact.complete');
    }
}
