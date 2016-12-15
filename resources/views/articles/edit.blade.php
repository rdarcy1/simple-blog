@extends('layout')

@section('title')
    Edit Article
@stop

@section('content')
    <h1>Edit Article</h1>

    <hr>

    @include('errors.form-list')

    @include('articles._form', [
        'formMethod'        => 'PATCH',
        'formAction'        => route('articles.update', $article->id),
        'submitButtonText'  => 'Update Article',
        'cancelAction'      => route('articles.show', $article->id)
    ])

@stop