@extends('layout')

@section('title', 'Edit Article')

@section('content')
    <div class="row">
        <form action="{{ route('article.edit', ['article' => $article->id]) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">{{ __('validation.attributes.title') }}</label>
                <input value="{{ old('title', $article->title) }}" name="title" type="text" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Categories</label>
                @error('categories')
                <div>{{ $message }}</div>
                @enderror
                @foreach($categories as $category)
                    <div class="form-check">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-check-input"
                        @if($article->categories->contains('id', $category->id)) checked @endif
                        > {{ $category->name }}
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="text">{{ __('validation.attributes.text') }}</label>
                <textarea name="text" rows="3"
                          class="form-control @error('text') is-invalid @enderror"
                >{{ old('text', $article->text) }}</textarea>
                @error('text')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <select name="status" class="form-select">
                    <option value="draft" @selected($article->status === 'draft')>Draft</option>
                    <option value="published" @selected($article->status === 'published')>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
