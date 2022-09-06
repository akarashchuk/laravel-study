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
                        <a href="{{ route('article.show', ['article' => $article->id]) }}">Show</a>
                        <br>
                        <a href="{{ route('article.edit.form', ['article' => $article->id]) }}">Edit</a>
                        <form action="{{ route('article.delete', ['article' => $article->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $articles->links() !!}
    </div>
@endsection
