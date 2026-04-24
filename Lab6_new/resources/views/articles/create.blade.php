@extends('layouts.app')

@section('content')
  <h1>Create Article</h1>

  <form method="POST" action="{{ route('articles.store') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" value="{{ old('title') }}">
      @error('title') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Body</label>
      <textarea name="body" class="form-control" rows="6">{{ old('body') }}</textarea>
      @error('body') <div class="text-danger">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary">Save</button>
  </form>

@endsection
