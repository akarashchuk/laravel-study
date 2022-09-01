@extends('layout')

@section('title', 'Articles List')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <th scope="row">{{ $article->id }}</th>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->created_at?->format('Y/m/d') }}</td>
                    <td>
                        <a href="{{ route('article.show', ['id' => $article->id]) }}">Show</a>
                        <br>
                        <a href="{{ route('article.edit.form', ['id' => $article->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
