@extends('layouts.app')

@section('content')
  <h1>Edit Article</h1>

  <form method="POST" action="{{ route('articles.update', $article) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}">
      @error('title') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Body</label>
      <textarea name="body" class="form-control" rows="6">{{ old('body', $article->body) }}</textarea>
      @error('body') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary">Update</button>
  </form>

@endsection
