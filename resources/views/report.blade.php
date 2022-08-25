@extends('layout')

@section('title', 'Send Report')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">Error!</div>
    @endif
    <div class="row">
        <form action="{{ route('report.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">{{ __('validation.attributes.title') }}</label>
                <input value="{{ old('title') }}" name="title" type="text" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('validation.attributes.email') }}</label>
                <input value="{{ old('email') }}" name="email" type="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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
