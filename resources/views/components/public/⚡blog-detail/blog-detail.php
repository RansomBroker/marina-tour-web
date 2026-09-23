<?php

use Livewire\Component;
use App\Models\Blog;

new class extends Component
{
    public $slug;
    public $blog;
    public $relatedBlogs;

    public function mount($slug)
    {
        $this->slug = $slug;
        $dbBlog = Blog::where('slug', $slug)->first();

        if (!$dbBlog) {
            abort(404);
        }

        $this->blog = [
            'slug' => $dbBlog->slug,
            'image' => str_starts_with($dbBlog->image, 'http') ? $dbBlog->image : asset('storage/' . $dbBlog->image),
            'category' => $dbBlog->category ?? 'Travel',
            'date' => $dbBlog->created_at->format('F d, Y'),
            'title' => $dbBlog->title,
            'description' => $dbBlog->description,
            'content' => $dbBlog->content,
            'meta_title' => $dbBlog->meta_title,
            'meta_description' => $dbBlog->meta_description,
        ];

        $this->relatedBlogs = Blog::where('slug', '!=', $slug)
            ->latest()
            ->take(3)
            ->get()
            ->map(function($rBlog) {
                return [
                    'image' => str_starts_with($rBlog->image, 'http') ? $rBlog->image : asset('storage/' . $rBlog->image),
                    'category' => $rBlog->category ?? 'Travel',
                    'date' => $rBlog->created_at->format('F d, Y'),
                    'title' => $rBlog->title,
                    'description' => $rBlog->description,
                    'slug' => $rBlog->slug,
                ];
            })
            ->toArray();
    }
};