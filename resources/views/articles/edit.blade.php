@extends('layout')

@section('content')
    <h1>Edit Article</h1>

    <a href="{{ route('articles.show', $article->id) }}" class="btn btn-default">Cancel</a>
    <hr>

    @include('errors.form-list')

    @include('articles._form', [
        'formMethod'        => 'PATCH',
        'formAction'        => route('articles.update', $article->id),
        'submitButtonText'  => 'Update Article'
    ])

@stop