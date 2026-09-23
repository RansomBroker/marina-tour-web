<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    use WithFileUploads;

    public ?int $blogId = null;
    public bool $isEditMode = false;

    // Form fields
    public string $title = '';
    public string $slug = '';
    public string $category = '';
    public ?string $image = null;
    public $newImage = null;
    public string $description = '';
    public string $content = '';
    public string $meta_title = '';
    public string $meta_description = '';

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $this->blogId,
            'category' => 'nullable|string|max:255',
            'newImage' => 'nullable|image|max:5120', // max 5MB
            'description' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ];
    }

    public function mount(?int $blogId = null): void
    {
        if ($blogId) {
            $this->blogId = $blogId;
            $this->isEditMode = true;

            $blog = Blog::findOrFail($blogId);
            $this->title = $blog->title;
            $this->slug = $blog->slug;
            $this->category = $blog->category ?? '';
            $this->image = $blog->image;
            $this->description = $blog->description ?? '';
            $this->content = $blog->content ?? '';
            $this->meta_title = $blog->meta_title ?? '';
            $this->meta_description = $blog->meta_description ?? '';
        }
    }

    public function updatedTitle($value): void
    {
        $this->slug = Str::slug($value);
        if (empty($this->meta_title)) {
            $this->meta_title = $value;
        }
    }

    public function updatedDescription($value): void
    {
        if (empty($this->meta_description)) {
            $this->meta_description = Str::limit($value, 155, '');
        }
    }

    public function save()
    {
        $this->validate();

        $imgPath = $this->image;
        if ($this->newImage) {
            // Delete old image if updating
            if ($this->isEditMode && $this->image && !str_starts_with($this->image, 'http')) {
                Storage::disk('public')->delete($this->image);
            }
            $imgPath = $this->newImage->store('blogs', 'public');
        }

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => $this->category ?: null,
            'image' => $imgPath,
            'description' => $this->description ?: null,
            'content' => $this->content,
            'meta_title' => $this->meta_title ?: null,
            'meta_description' => $this->meta_description ?: null,
        ];

        if ($this->isEditMode) {
            $blog = Blog::findOrFail($this->blogId);
            $blog->update($data);
            
            session()->flash('success', 'Blog post updated successfully!');
        } else {
            Blog::create($data);
            
            session()->flash('success', 'Blog post created successfully!');
        }

        return redirect()->route('admin.blogs');
    }

    public function render()
    {
        return view('components.admin.⚡blog-form.blog-form');
    }
};
