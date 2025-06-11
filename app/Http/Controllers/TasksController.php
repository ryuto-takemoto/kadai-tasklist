<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth; // Authファサードを追加

class TasksController extends Controller
{
    // トップページ
    public function top()
    {
        if (Auth::check()) {
            // ログイン済みの場合、タスク一覧を表示
            $tasks = Task::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(25);
            return view('tasks.index', [
                'tasks' => $tasks,
            ]);
        } else {
            // 未ログインの場合、dashboard.blade.php を表示
            return view('dashboard');
        }
    }

    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        // 認証済みユーザーのタスク一覧を取得
        $tasks = Task::where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(25);

        // タスク一覧ビューでそれを表示
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

        // タスクを作成
        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->user_id = Auth::id(); // 認証済みユーザーのIDを保存
        $task->save();

        // 詳細ページへリダイレクトさせる
        return redirect()->route('tasks.show', $task->id);
    }

    // getでtasks/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        try {
            // 認証済みユーザーのタスクを取得
            $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

            // タスク詳細ビューでそれを表示
            return view('tasks.show', [
                'task' => $task,
            ]);
        } catch (\Exception $e) {
            // 他のユーザーのタスクにアクセスしようとした場合、トップページにリダイレクト
            return redirect('/')->with('error', 'アクセス権がありません。');
        }
    }

    // getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        try {
            // 認証済みユーザーのタスクを取得
            $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

            // タスク編集ビューを表示
            return view('tasks.edit', [
                'task' => $task,
            ]);
        } catch (\Exception $e) {
            // 他のユーザーのタスクにアクセスしようとした場合、トップページにリダイレクト
            return redirect('/')->with('error', 'アクセス権がありません。');
        }
    }

    // putまたはpatchでtasks/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);

        try {
            // 認証済みユーザーのタスクを取得
            $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

            // タスクを更新
            $task->content = $request->content;
            $task->status = $request->status;
            $task->save();

            // 詳細ページへリダイレクトさせる
            return redirect()->route('tasks.show', $task->id);
        } catch (\Exception $e) {
            // 他のユーザーのタスクにアクセスしようとした場合、トップページにリダイレクト
            return redirect('/')->with('error', 'アクセス権がありません。');
        }
    }

    // deleteでtasks/idにアクセスされた場合の「削除処理」
    public function destroy(string $id)
    {
        try {
            // 認証済みユーザーのタスクを取得
            $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

            // タスクを削除
            $task->delete();

            // トップページへリダイレクトさせる
            return redirect('/')->with('success', 'タスクを削除しました。');
        } catch (\Exception $e) {
            // 他のユーザーのタスクにアクセスしようとした場合、トップページにリダイレクト
            return redirect('/')->with('error', 'アクセス権がありません。');
        }
    }
}