@extends('layout')

@section('title')
    {{ $article->title }}
@stop

@section('content')
    @include('articles._delete-button', ['articleId' => $article->id])
    @include('articles._back-button', ['action' => route('articles.index')])
    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-default">Edit</a>


    <h2>{{ $article->title }}</h2>
    <h5>Published on <strong>{{ $article->published_on }}</strong> by <strong>{{ $article->user->name }}</strong></h5>
    <hr>
    <p>{{ $article->body }}</p>
@stop
