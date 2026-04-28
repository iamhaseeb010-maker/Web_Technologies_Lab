<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::orderBy('created_at', 'desc')->get();
        return view('links.index', compact('links'));
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:1024',
            'path' => 'nullable|string|max:1024',
        ]);

        Link::create($data);
        return redirect()->route('links.index')->with('success', 'Link created.');
    }

    public function edit(Link $link)
    {
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, Link $link)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:1024',
            'path' => 'nullable|string|max:1024',
        ]);

        $link->update($data);
        return redirect()->route('links.index')->with('success', 'Link updated.');
    }

    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->route('links.index')->with('success', 'Link deleted.');
    }
}
