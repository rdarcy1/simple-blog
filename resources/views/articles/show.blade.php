@extends('layout')

@section('title')
    {{ $article->title }}
@stop

@section('content')
    @include('articles._delete-button', ['articleId' => $article->id])
    <a href="/articles" class="btn btn-default">&lsaquo; Back to all articles</a>
    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-default">Edit</a>


    <h2>{{ $article->title }}</h2>
    <h5>Published on {{ $article->published_on }}</h5>
    <hr>
    <p>{{ $article->body }}</p>
@stop
