<?php

namespace App\Http\Livewire\Admin\Helpers;

use Livewire\Component;
use App\Models\Media as M;
use Livewire\WithPagination;

class Media extends Component
{
    use WithPagination;
    
    public $from;

    public $page = 1;
    public $totalPages;
    
    public function mount($from)
    {
        $this->from = $from;
    }

    public function render()
    {
        $medias           = M::latest()->paginate(8);
        $this->totalPages = $medias->total();
    
        return view('livewire.admin.helpers.media', [
            'medias'  => $medias
        ]);
    }

    public function passMediaId($id)
    {
        $this->emit('mediaId', $id);
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
