@extends('layout')

@section('title')
    Create New Article
@stop

@section('content')
    <h1>Create New Article</h1>

    <a href="{{ route('articles.index') }}" class="btn btn-default">&lt; Back to articles</a>
    <hr>

    @include('errors.form-list')

    @include('articles._form', [
        'formMethod'        => 'POST',
        'formAction'        => route('articles.store'),
        'submitButtonText'  => 'Create Article'
    ])
@stop