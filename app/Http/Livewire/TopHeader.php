<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class TopHeader extends Component
{
    public $author;

    protected $listeners = [
        'UpdateTopHeader' => '$refresh',
    ];

    public function mount()
    {
        $this->author = User::find(auth('web')->id());
    }
    public function render()
    {
        return view('livewire.top-header');
    }
}
