@extends('layout')

@section('content')
    <div class="alert-danger">
        <h2>Are you sure you wish to delete this article?</h2>
        @include('articles._delete-button', ['confirmed' => true, 'articleId' => $article->id])
        @include('articles._back-button')
    </div>
@stop