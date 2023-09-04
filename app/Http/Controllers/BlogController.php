<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('blog.index', [
            'posts' => Blog::with('user')->latest()->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->blog()->create($validated);

        return redirect(route('blog.index'));
    }

    public function edit(Blog $blog): View
    {
        //
        $this->authorize('update', $blog);

        return view('blog.edit', [
            'post' => $blog,
        ]);
    }

    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $this->authorize('update', $blog);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $blog->update($validated);

        return redirect(route('blog.index'));
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $this->authorize('delete', $blog);

        $blog->delete();

        return redirect(route('blog.index'));
    }

}
