{{--articles/create.report.blade--}}

@extends('layout')

@section('title', 'Create Article')

@section('content')
    <div class="row">
        <form action="{{ route('article.create') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">{{ __('validation.attributes.title') }}</label>
                <input value="{{ old('title') }}" name="title" type="text" class="form-control @error('title') is-invalid @enderror">
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
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-check-input"> {{ $category->name }}
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="text">{{ __('validation.attributes.text') }}</label>
                <textarea name="text" rows="3"
                          class="form-control @error('text') is-invalid @enderror"
                >{{ old('text') }}</textarea>
                @error('text')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
