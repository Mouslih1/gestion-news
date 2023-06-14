<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class AuthorFooter extends Component
{
    protected $listeners = [
        'updateAuthorFooter' => '$refresh'
    ];

    public $settings;
    public $blog_name, $blog_email, $blog_description;
    public function mount()
    {
        $this->settings = Setting::find(2);
        $this->blog_name = $this->settings->blog_name;
        $this->blog_email = $this->settings->blog_email;
        $this->blog_description = $this->settings->blog_description;
    }

    public function render()
    {
        return view('livewire.author-footer');
    }
}
