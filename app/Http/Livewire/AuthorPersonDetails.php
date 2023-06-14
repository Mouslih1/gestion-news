<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AuthorPersonDetails extends Component
{
    public $author;
    public $name, $username, $email, $biography;

    public function mount()
    {
        $this->author = User::find(auth('web')->id());
        $this->name = $this->author->name;
        $this->username = $this->author->username;
        $this->email = $this->author->email;
        $this->biography = $this->author->biography;
    }

    public function UpdateDetails()
    {
        $this->validate([
            'name' => 'required|string',
            'username' => 'required|unique:users,username,'.auth('web')->id(),
        ]);

        User::where('id', auth('web')->id())->update([
            'name' => $this->name,
            'username' => $this->username,
            'biography' => $this->biography,
        ]);

        $this->emit('UpdateAuthorHeaderProfil');
        $this->emit('UpdateTopHeader');

        $this->showToastr('Your Profile info have been successfuly updated','success');
        //dd($this->showToastr('Your Profile info have been successfuly updated','success'));
    }

    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr',[
            'type' => $type,
            'message' => $message,
        ]);
    }

    public function render()
    {
        return view('livewire.author-person-details');
    }
}
