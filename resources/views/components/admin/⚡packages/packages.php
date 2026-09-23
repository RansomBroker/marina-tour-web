<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TourPackage;
use App\Models\TourCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    use WithFileUploads;

    // List & Query state
    public $packages;
    public $categories;
    
    // Modal states
    public $isModalOpen = false;
    public $editingPackageId = null;

    // Form fields
    public $tour_category_id;
    public $name;
    public $slug;
    public $price;
    public $duration;
    public $description;
    public $newImages = []; // Temp uploads
    public $existingImages = []; // Stored paths
    public $itinerary = []; // [['day' => 1, 'title' => '', 'description' => '']]
    public $highlights = []; // ['']
    public $included = []; // ['']
    public $excluded = []; // ['']
    public $what_to_bring = []; // ['']
    public $cancellation_policy;
    public $faq = []; // [['question' => '', 'answer' => '']]
    public $selectedRelatedPackages = []; // IDs of related packages

    // Confirmation Modal state
    public $isConfirmModalOpen = false;
    public $confirmType = 'warning';
    public $confirmTitle = '';
    public $confirmMessage = '';
    public $confirmActionMethod = '';
    public $confirmTargetId = null;

    protected function rules()
    {
        return [
            'tour_category_id' => 'required|exists:tour_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tour_packages,slug,' . $this->editingPackageId,
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
            'description' => 'nullable|string',
            'newImages.*' => 'nullable|image|max:5120', // max 5MB
            'cancellation_policy' => 'nullable|string',
            'itinerary.*.day' => 'required|integer',
            'itinerary.*.title' => 'required|string',
            'itinerary.*.description' => 'nullable|string',
            'faq.*.question' => 'required|string',
            'faq.*.answer' => 'required|string',
        ];
    }

    public function mount()
    {
        $this->categories = TourCategory::orderBy('name')->get();
        $this->loadPackages();
    }

    public function loadPackages()
    {
        $this->packages = TourPackage::with('category')->orderBy('created_at', 'desc')->get();
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    // Dynamic Lists Helpers
    public function addHighlight() { $this->highlights[] = ''; }
    public function removeHighlight($index) { unset($this->highlights[$index]); $this->highlights = array_values($this->highlights); }

    public function addIncluded() { $this->included[] = ''; }
    public function removeIncluded($index) { unset($this->included[$index]); $this->included = array_values($this->included); }

    public function addExcluded() { $this->excluded[] = ''; }
    public function removeExcluded($index) { unset($this->excluded[$index]); $this->excluded = array_values($this->excluded); }

    public function addWhatToBring() { $this->what_to_bring[] = ''; }
    public function removeWhatToBring($index) { unset($this->what_to_bring[$index]); $this->what_to_bring = array_values($this->what_to_bring); }

    public function addItinerary() 
    { 
        $dayNum = count($this->itinerary) + 1;
        $this->itinerary[] = ['day' => $dayNum, 'title' => '', 'description' => '']; 
    }
    public function removeItinerary($index) 
    { 
        unset($this->itinerary[$index]); 
        $this->itinerary = array_values($this->itinerary);
        // Re-index day numbers
        foreach ($this->itinerary as $k => $day) {
            $this->itinerary[$k]['day'] = $k + 1;
        }
    }

    public function addFaq() { $this->faq[] = ['question' => '', 'answer' => '']; }
    public function removeFaq($index) { unset($this->faq[$index]); $this->faq = array_values($this->faq); }

    public function removeExistingImage($index)
    {
        unset($this->existingImages[$index]);
        $this->existingImages = array_values($this->existingImages);
    }

    public function openCreateModal()
    {
        $this->resetErrorBag();
        $this->reset([
            'editingPackageId', 'tour_category_id', 'name', 'slug', 'price', 'duration', 
            'description', 'newImages', 'existingImages', 'itinerary', 'highlights', 
            'included', 'excluded', 'what_to_bring', 'cancellation_policy', 'faq', 'selectedRelatedPackages'
        ]);
        $this->isModalOpen = true;
    }

    public function openEditModal($id)
    {
        $this->resetErrorBag();
        $package = TourPackage::with('relatedPackages')->findOrFail($id);
        
        $this->editingPackageId = $package->id;
        $this->tour_category_id = $package->tour_category_id;
        $this->name = $package->name;
        $this->slug = $package->slug;
        $this->price = $package->price;
        $this->duration = $package->duration;
        $this->description = $package->description;
        $this->existingImages = $package->images ?? [];
        $this->newImages = [];
        $this->itinerary = $package->itinerary ?? [];
        $this->highlights = $package->highlights ?? [];
        $this->included = $package->included ?? [];
        $this->excluded = $package->excluded ?? [];
        $this->what_to_bring = $package->what_to_bring ?? [];
        $this->cancellation_policy = $package->cancellation_policy;
        $this->faq = $package->faq ?? [];
        $this->selectedRelatedPackages = $package->relatedPackages->pluck('id')->toArray();

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $this->validate();

        // Save images
        $images = $this->existingImages;
        if (!empty($this->newImages)) {
            foreach ($this->newImages as $img) {
                $path = $img->store('packages', 'public');
                $images[] = $path;
            }
        }

        // Clean arrays
        $highlights = array_values(array_filter($this->highlights));
        $included = array_values(array_filter($this->included));
        $excluded = array_values(array_filter($this->excluded));
        $what_to_bring = array_values(array_filter($this->what_to_bring));

        $data = [
            'tour_category_id' => $this->tour_category_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'duration' => $this->duration,
            'description' => $this->description,
            'images' => $images,
            'itinerary' => $this->itinerary,
            'highlights' => $highlights,
            'included' => $included,
            'excluded' => $excluded,
            'what_to_bring' => $what_to_bring,
            'cancellation_policy' => $this->cancellation_policy,
            'faq' => $this->faq,
        ];

        if ($this->editingPackageId) {
            $package = TourPackage::findOrFail($this->editingPackageId);
            $package->update($data);
            $package->relatedPackages()->sync($this->selectedRelatedPackages);
            $this->dispatch('toast', message: 'Tour Package updated successfully.', type: 'success');
            session()->flash('message', 'Tour Package updated successfully.');
        } else {
            $package = TourPackage::create($data);
            $package->relatedPackages()->sync($this->selectedRelatedPackages);
            $this->dispatch('toast', message: 'Tour Package created successfully.', type: 'success');
            session()->flash('message', 'Tour Package created successfully.');
        }

        $this->closeModal();
        $this->loadPackages();
    }

    public function confirmDelete($id)
    {
        $package = TourPackage::findOrFail($id);
        $this->confirmTargetId = $id;
        $this->confirmType = 'danger';
        $this->confirmTitle = 'Delete Tour Package';
        $this->confirmMessage = 'Are you sure you want to delete tour package "' . $package->name . '"? This action cannot be undone.';
        $this->confirmActionMethod = 'executeDelete';
        $this->isConfirmModalOpen = true;
    }

    public function executeDelete()
    {
        if ($this->confirmTargetId) {
            $package = TourPackage::findOrFail($this->confirmTargetId);
            // Delete images from disk
            if ($package->images) {
                foreach ($package->images as $img) {
                    Storage::disk('public')->delete($img);
                }
            }
            $package->delete();
            $this->dispatch('toast', message: 'Tour Package deleted successfully.', type: 'success');
            session()->flash('message', 'Tour Package deleted successfully.');
            $this->loadPackages();
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
