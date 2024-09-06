<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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

        return to_route('photos.create')->with(
            'success',
            'アップロードしました'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
