<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;    // 追加

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
      // メッセージ一覧を取得
        $tasks = Task::orderBy('id', 'desc')->paginate(25);

        // メッセージ一覧ビューでそれを表示
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    // getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $task = new Task;

        // メッセージ作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    // postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);

        // メッセージを作成
        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();

        // 詳細ページへリダイレクトさせる
        return redirect()->route('tasks.show', $task->id);
    }

    // getでtasks/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);

        // メッセージ詳細ビューでそれを表示
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    // getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);

        // メッセージ編集ビューを表示
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    // putまたはpatchでtasks/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);

        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        // メッセージを更新
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();

        // 詳細ページへリダイレクトさせる
        return redirect()->route('tasks.show', $task->id);
    }

    // deleteでtasks/idにアクセスされた場合の「削除処理」
    public function destroy(string $id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        // メッセージを削除
        $task->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}