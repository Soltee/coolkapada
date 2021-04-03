<?php

namespace App\Http\Livewire\Admin\Helpers;

use Livewire\Component;
use App\Models\Media as M;
use Livewire\WithPagination;

class Media extends Component
{
    use WithPagination;
    
    public $page = 1;
    public $totalPages;
    
    public function mount()
    {
    }

    public function render()
    {
        $medias           = M::latest()->paginate(20);
        $this->totalPages = $medias->total();
    
        return view('livewire.admin.helpers.media', [
            'medias'  => $medias
        ]);
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page = $this->page - 1;
        }
    }

    public function nextPage()
    {
        if ($this->page < $this->totalPages) {
            $this->page = $this->page + 1;
        }
    }
}
