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
                <label for="title">Title</label>
                <input value="{{ old('title') }}" name="title" type="text" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
