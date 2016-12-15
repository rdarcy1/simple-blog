@extends('layout')

@section('title')
    Create New Article
@stop

@section('content')
    <h1>Create New Article</h1>

    @include('articles._back-button', ['action' => route('articles.index')])
    <hr>

    @include('errors.form-list')

    @include('articles._form', [
        'formMethod'        => 'POST',
        'formAction'        => route('articles.store'),
        'submitButtonText'  => 'Create Article',
        'cancelAction'      => route('articles.index')
    ])
@stop