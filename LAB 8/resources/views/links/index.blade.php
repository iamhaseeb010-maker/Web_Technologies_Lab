@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Links</h1>
        <a href="{{ route('links.create') }}" class="btn btn-primary">New Link</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>URL</th>
                <th>Path</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($links as $link)
            <tr>
                <td>{{ $link->name }}</td>
                <td><a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a></td>
                <td>{{ $link->path }}</td>
                <td>
                    <a href="{{ route('links.edit', $link) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('links.destroy', $link) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Delete this link?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
