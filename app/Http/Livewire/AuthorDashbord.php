<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;


class AuthorDashbord extends Component
{
    use WithPagination;
    public $search;

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
        return view('livewire.author-dashbord',  [
            'authorspaginate' => User::search(trim($this->search))->where('id', '!=', auth()->id())->paginate(5)
        ]);
    }
}
