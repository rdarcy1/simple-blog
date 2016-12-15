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
        <h5>{{ $article->published_on }}</h5>
        <p>{{ $article->body }}</p>

        @unless($loop->last)
            <hr>
        @endunless
    @endforeach

    <ul class="pagination">
        @for ($page = 1; $page <= $numberOfArticles; $page++)
            <li @if ($currentPage == $page) class="active" @endif >
                <a href="{{ route('articles.page', $page) }}" {{ $page }}>
                    {{ $page }}
                </a>
            </li>
        @endfor
    </ul>

@stop