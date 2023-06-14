<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class AuthorGeneralSettings extends Component
{
    public $settings;
    public $blog_name, $blog_email, $blog_description;
    public function mount()
    {
        $this->settings = Setting::find(2);
        $this->blog_name = $this->settings->blog_name;
        $this->blog_email = $this->settings->blog_email;
        $this->blog_description = $this->settings->blog_description;
    }

    public function updateGeneralSettings()
    {
        $this->validate([
            'blog_name' => 'required|string',
            'blog_email' => 'required|email',
        ],[
            'blog_name.required' => 'Enter blog name',
            'blog_email.required' => 'Enter blog email',
        ]);

        $update = $this->settings->update([
            'blog_name' => $this->blog_name,
            'blog_email' => $this->blog_email,
            'blog_description' => $this->blog_description
        ]);

        if($update)
        {
            $this->showToastr('General settings have been successfully updated', 'success');
        }else{
            $this->showToastr('Somethings went wrong !', 'error');
        }

        $this->emit('updateAuthorFooter');
    }

    public function showToastr($message, $type)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'message' => $message,
            'type' => $type
        ]);

    }

    public function render()
    {
        return view('livewire.author-general-settings');
    }
}
