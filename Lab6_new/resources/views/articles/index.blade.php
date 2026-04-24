@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h1>Articles</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary">Create Article</a>
  </div>

  @if($articles->count())
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Title</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($articles as $article)
          <tr>
            <td><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></td>
            <td>
              <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-secondary">Edit</a>
              <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $articles->links() }}
  @else
    <p>No articles yet.</p>
  @endif

@endsection
