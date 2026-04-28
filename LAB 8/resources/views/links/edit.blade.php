@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Link</h1>

    <form method="POST" action="{{ route('links.update', $link) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $link->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">URL</label>
            <input type="url" name="url" class="form-control" value="{{ old('url', $link->url) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Path (optional)</label>
            <input type="text" name="path" class="form-control" value="{{ old('path', $link->path) }}">
        </div>
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('links.index') }}" class="btn btn-link">Cancel</a>
    </form>
</div>
@endsection
