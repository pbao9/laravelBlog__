<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;
    public $perpage = 8;
    public $search = null;
    public $orderBy = 'asc';

    public function mount()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.all-posts', [
            'posts' => auth()->user()->type == 1 ?
                Post::search(trim($this->search))
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perpage) :
                Post::search(trim($this->search))
                ->where('author_id', auth()->id())
                ->when($this->orderBy, function ($query) {
                    $query->orderBy('id', $this->orderBy);
                })
                ->paginate($this->perpage)
        ]);
    }
}
