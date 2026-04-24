@extends('layouts.app')

@section('content')
  <h1>{{ $article->title }}</h1>
  <div class="mb-3">{{ $article->body }}</div>
  <a href="{{ route('articles.edit', $article) }}" class="btn btn-secondary">Edit</a>
  <a href="{{ route('articles.index') }}" class="btn btn-link">Back</a>
@endsection
