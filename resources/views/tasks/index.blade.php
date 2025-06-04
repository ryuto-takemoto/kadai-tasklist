@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2 class="text-lg">メッセージ 一覧</h2>
    </div>

    @if (isset($messages))
        <table class="table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>id</th>
                    <th>メッセージ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                <tr>
                    <td><a class="link link-hover text-info" href="#">{{ $message->id }}</a></td>
                    <td>{{ $message->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection