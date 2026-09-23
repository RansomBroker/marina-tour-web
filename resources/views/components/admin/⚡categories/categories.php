<?php

use Livewire\Component;
use App\Models\TourCategory;
use Illuminate\Support\Str;

new class extends Component
{
    public $categories;
    public $name;
    public $slug;
    public $description;
    public $editingCategoryId = null;

    public $isModalOpen = false;

    // Confirmation Modal Properties
    public $isConfirmModalOpen = false;
    public $confirmType = 'warning';
    public $confirmTitle = '';
    public $confirmMessage = '';
    public $confirmActionMethod = '';
    public $confirmTargetId = null;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tour_categories,slug,' . $this->editingCategoryId,
            'description' => 'nullable|string',
        ];
    }

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = TourCategory::orderBy('created_at', 'desc')->get();
    }

    public function updatedName($value)
    {
        if (!$this->editingCategoryId) {
            $this->slug = Str::slug($value);
        }
    }

    public function openCreateModal()
    {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'description', 'editingCategoryId']);
        $this->isModalOpen = true;
    }

    public function openEditModal($id)
    {
        $this->resetErrorBag();
        $category = TourCategory::findOrFail($id);
        $this->editingCategoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $this->validate();

        if ($this->editingCategoryId) {
            $category = TourCategory::findOrFail($this->editingCategoryId);
            $category->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
            ]);
            $this->dispatch('toast', message: 'Category updated successfully.', type: 'success');
            session()->flash('message', 'Category updated successfully.');
        } else {
            TourCategory::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
            ]);
            $this->dispatch('toast', message: 'Category created successfully.', type: 'success');
            session()->flash('message', 'Category created successfully.');
        }

        $this->closeModal();
        $this->loadCategories();
    }

    public function confirmDelete($id)
    {
        $category = TourCategory::findOrFail($id);
        $this->confirmTargetId = $id;
        $this->confirmType = 'danger';
        $this->confirmTitle = 'Delete Category';
        $this->confirmMessage = 'Are you sure you want to delete category "' . $category->name . '"? This action cannot be undone and will affect tour packages using this category.';
        $this->confirmActionMethod = 'executeDelete';
        $this->isConfirmModalOpen = true;
    }

    public function executeDelete()
    {
        if ($this->confirmTargetId) {
            $category = TourCategory::findOrFail($this->confirmTargetId);
            $category->delete();
            $this->dispatch('toast', message: 'Category deleted successfully.', type: 'success');
            session()->flash('message', 'Category deleted successfully.');
            $this->loadCategories();
        }
        $this->closeConfirmModal();
    }

    public function closeConfirmModal()
    {
        $this->isConfirmModalOpen = false;
        $this->confirmTargetId = null;
        $this->confirmActionMethod = '';
    }
};
