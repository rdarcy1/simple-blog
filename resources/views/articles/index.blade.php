@extends('layout')

@section('content')
    <a href="{{ route('articles.create') }}" class="btn btn-default">Create new article</a>

    @foreach ($articles as $article)
        <a href="/articles/{{ $article->id }}">
            <h2>{{ $article->title }}</h2>
        </a>
        <p>{{ $article->body }}</p>

        @unless($loop->last)
            <hr>
        @endunless
    @endforeach
@stop