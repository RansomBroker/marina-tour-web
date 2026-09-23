<?php

use Livewire\Component;
use App\Models\Blog;

new class extends Component
{
    public function render()
    {
        $blogs = Blog::latest()->get()->map(function($blog) {
            return [
                'image' => str_starts_with($blog->image, 'http') ? $blog->image : asset('storage/' . $blog->image),
                'category' => $blog->category ?? 'Travel',
                'date' => $blog->created_at->format('F d, Y'),
                'title' => $blog->title,
                'description' => $blog->description,
                'slug' => $blog->slug,
            ];
        });

        return view('components.public.⚡blogs.blogs', [
            'blogs' => $blogs
        ]);
    }
};