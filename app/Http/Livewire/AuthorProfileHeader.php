<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AuthorProfileHeader extends Component
{
    public $author;

    protected $listeners = [
        'UpdateAuthorHeaderProfil' => '$refresh',
    ];

    public function mount()
    {
        $this->author = User::find(auth('web')->id());
    }
    public function render()
    {
        return view('livewire.author-profile-header',[
            'authors' => User::where('blocked', 0)->where('id', '!=', auth('web')->id())->get()
        ]);
    }
}
