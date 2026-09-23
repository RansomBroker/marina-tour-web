<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inquiry;

new class extends Component
{
    use WithPagination;

    public string $search = '';
    public ?Inquiry $selectedInquiry = null;
    public bool $isDetailOpen = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function viewDetails(int $id): void
    {
        $this->selectedInquiry = Inquiry::with('package')->find($id);
        if ($this->selectedInquiry) {
            $this->isDetailOpen = true;
        }
    }

    public function deleteInquiry(int $id): void
    {
        $inquiry = Inquiry::find($id);
        if ($inquiry) {
            $inquiry->delete();
            $this->dispatch('toast', message: 'Inquiry deleted successfully!', type: 'success');
            
            if ($this->selectedInquiry && $this->selectedInquiry->id === $id) {
                $this->isDetailOpen = false;
                $this->selectedInquiry = null;
            }
        }
    }

    public function render()
    {
        $inquiries = Inquiry::with('package')
            ->when($this->search, function ($query) {
                $query->where(function ($sub) {
                    $sub->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('whatsapp_number', 'like', '%' . $this->search . '%')
                        ->orWhere('message', 'like', '%' . $this->search . '%')
                        ->orWhereHas('package', function ($pkg) {
                            $pkg->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->latest()
            ->paginate(10);

        return view('components.admin.⚡inquiries.inquiries', [
            'inquiries' => $inquiries
        ]);
    }
};
