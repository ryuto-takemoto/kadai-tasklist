@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2 class="text-lg">タスク一覧</h2>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    @auth
        @if (isset($tasks))
            <table class="table table-zebra w-full my-4">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>タスク</th>
                        <th>ステータス</th>
                        <th>担当者</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td><a class="link link-hover text-info" href="{{ route('tasks.show', $task->id) }}">{{ $task->id }}</a></td>
                            <td>{{ $task->content }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->user->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- ページネーションのリンク --}}
        {{ $tasks->links() }}

        {{-- タスク作成ページへのリンク --}}
        <a class="btn btn-primary" href="{{ route('tasks.create') }}">新規タスクの投稿</a>
    @else
        <p>タスクを表示するには<a href="{{ route('login') }}">ログイン</a>してください。</p>
    @endauth

@endsection