@extends('layout')

@section('title')
    {{ $article->title }}
@stop

@section('content')
    @include('articles._delete-button', ['articleId' => $article->id])
    @include('articles._back-button')
    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-default">Edit</a>


    <h2>{{ $article->title }}</h2>
    <h5>Published on {{ $article->published_on }}</h5>
    <hr>
    <p>{{ $article->body }}</p>
@stop
