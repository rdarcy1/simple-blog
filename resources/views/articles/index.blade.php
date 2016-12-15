@extends('layout')

@section('title')
    Home
@stop

@section('content')
    <h1>Simple Blog</h1>

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

    @if (isset($page))
        <h5>Page {{ $page }}</h5>
    @endif

@stop