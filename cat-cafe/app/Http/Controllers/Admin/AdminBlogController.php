<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller {
    //ブログ一覧画面
    public function index() {
        $blogs = Blog::latest('updated_at')->paginate(10);
        return view('admin.blogs.index', ['blogs' => $blogs]);
    }

    //ブログ投稿画面
    public function create() {
        return view('admin.blogs.create');
    }

    //ブログ投稿処理
    public function store(StoreBlogRequest $request) {
        //Modelから登録した場合
        // $savedImagePath = $request->file('image')->store('blogs', 'public');
        // $blog = new Blog($request->validated());
        // $blog->image = $savedImagePath;
        // $blog->save();

        //Createで作成した場合
        $validated = $request->validated();
        $validated['image'] = $request->file('image')->store('blogs', 'public');
        Blog::create($validated);
        return to_route('admin.blogs.index')->with(
            'success',
            'ブログを投稿しました',
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    //指定したIDのブログ編集画面
    public function edit(string $id) {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, string $id) {
        $blog = Blog::findOrFail($id);
        $updateDate = $request->validated();

        //画像を変更する場合
        if ($request->has('image')) {
            //変更前の画像を削除
            Storage::disk('public')->delete($blog->image);
            //変更後の画像をアップロード、保存パスを更新対象データにセット
            $updateDate['image'] = $request
                ->file('image')
                ->store('blogs', 'public');
        }
        $blog->update($updateDate);

        return to_route('admin.blogs.index')->with(
            'success',
            'ブログを更新しました',
        );
    }

    //指定したIDのブログの削除処理
    public function destroy(string $id) {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        Storage::disk('public')->delete($blog->image);

        return to_route('admin.blogs.index')->with(
            'success',
            'ブログを削除しました',
        );
    }
}
