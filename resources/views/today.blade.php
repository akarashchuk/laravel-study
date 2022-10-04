@extends('layout')

@section('title', 'Main')

@section('content')
    <div class="row mt-4">
        <div class="col-md-8">
            @if($articles->isEmpty())
                <h2>Articles not found</h2>
            @endif
            @foreach($articles as $article)
                <article class="mb-3">
                    <h2 class="mb-1">{{ $article->title }}</h2>
                    <p class="mb-1 text-muted">{{ $article->created_at->format('j F Y') }} by {{ $article->user->name }}</p>
                    <p class="mb-1">
                        @foreach($article->categories as $category)
                            <span>{{ $category->name }}</span>
                        @endforeach
                    </p>
                    <p>Content</p>
                </article>
            @endforeach
            <div class="d-flex justify-content-center">
                {!! $articles->links() !!}
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
@endsection
