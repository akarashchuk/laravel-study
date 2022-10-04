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
                    <p>{{ $article->short_description }}</p>
                </article>
            @endforeach
            <div class="d-flex justify-content-center">
                {!! $articles->links() !!}
            </div>
        </div>
        <div class="col-md-4">
            <ul class="list-unstyled">
{{--                @foreach($categories as $category)--}}
{{--                    <li><a href="{{ route('main', ['category' => $category->id]) }}">{{ $category->name }}</a></li>--}}
{{--                @endforeach--}}
                <form action="{{ route('main') }}">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Title" name="title" value="{{ request()->get('title') }}">
                    </div>
                    @foreach($categories as $category)
                        <div class="form-check">
                            <input type="checkbox"
                                   name="categories[]"
                                   value="{{ $category->id }}"
                                   @if(in_array($category->id, request()->get('categories', [])))
                                       checked
                                @endif
                            > {{ $category->name }}
                        </div>
                    @endforeach
                    <button class="btn btn-primary">Search</button>
                </form>
            </ul>
        </div>
    </div>
@endsection
