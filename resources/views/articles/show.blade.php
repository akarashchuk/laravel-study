@extends('layout')

@section('title', 'Show article')

@section('content')
    <h3>{{ $article->title }}</h3>
    <h4>{{ $article->user->name }}</h4>
    <h4>{{ $article->created_at?->format('Y/m/d') }}</h4>
    <p>{!! nl2br(strip_tags($article->text)) !!}</p>
@endsection
