<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    use WithPagination;

    public string $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteBlog(int $id): void
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image && !str_starts_with($blog->image, 'http')) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        $this->dispatch('toast', message: 'Blog post deleted successfully!', type: 'success');
        $this->resetPage();
    }

    public function render()
    {
        $blogs = Blog::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('category', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('components.admin.⚡blogs.blogs', [
            'blogs' => $blogs
        ]);
    }
};
