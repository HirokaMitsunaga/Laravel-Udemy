<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    //アップロード画面
    public function create() {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $savedFilePath = $request->file('image')->store('photos', 'public');
        Log::debug($savedFilePath);

        //ファイル名だけを取得するための処理
        //例　 photos/Lbs75opF96ULzxs0Sl7cP2SUnsDhaG3gZYDXGQqq.html →Lbs75opF96ULzxs0Sl7cP2SUnsDhaG3gZYDXGQqq.html
        $fileName = pathinfo($savedFilePath, PATHINFO_BASENAME);

        return to_route('photos.show', ['photo' => $fileName])->with(
            'success',
            'アップロードしました'
        );
    }

    //アップロード画像の表示
    public function show(string $fileName) {
        return view('photos.show', ['fileName' => $fileName]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    //ファイルの削除
    public function destroy(string $fileName) {
        Storage::disk('public')->delete('photos/' . $fileName);
        return to_route('photos.create')->with('delete', '削除が完了しました');
    }
}
