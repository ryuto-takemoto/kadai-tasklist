@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2 class="text-lg">タスク新規作成ページ</h2>
    </div>

    @auth
        <div class="flex justify-center">
            <form method="POST" action="{{ route('tasks.store') }}" class="w-1/2">
                @csrf

                <div class="form-control my-4">
                    <label for="content" class="label">
                        <span class="label-text">タスク:</span>
                    </label>
                    <input type="text" name="content" class="input input-bordered w-full">
                    @error('content')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-control my-4">
                    <label for="status" class="label">
                        <span class="label-text">ステータス:</span>
                    </label>
                    <input type="text" name="status" class="input input-bordered w-full">
                    @error('status')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-outline">投稿</button>
            </form>
        </div>
    @else
        <p>タスクを作成するには<a href="{{ route('login') }}">ログイン</a>してください。</p>
    @endauth

@endsection