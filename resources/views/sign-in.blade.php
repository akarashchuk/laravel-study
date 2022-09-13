@extends('layout')

@section('title', 'Sign In')

@section('content')
    <div class="row">
        <form action="{{ route('sign-in') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('validation.attributes.email') }}</label>
                <input value="{{ old('email') }}" name="email" type="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('validation.attributes.password') }}</label>
                <input value="{{ old('password') }}" name="password" type="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Sign In</button>
            </div>
        </form>
    </div>
@endsection
