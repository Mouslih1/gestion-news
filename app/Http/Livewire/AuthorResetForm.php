<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthorResetForm extends Component
{
    public $email, $token, $new_password, $confirm_new_password;
    public function mount()
    {
        $this->email = request()->email;
        $this->token = request()->token;
    }

    public function resetHandler()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|min:5',
            'confirm_new_password' => 'same:new_password',
        ],[
            'email.required' => 'This email is required',
            'email.email' => 'Invalid email address',
            'email.exists' => 'This email is not registered in database',
            'new_password.required' => 'This password is required',
            'new_password.min' => 'Minimun characters is must be 5',
            'confirm_new_password' => 'The confirm password and new password is match',
        ]);

        $check_token = DB::table('password_reset_tokens')->where([
            'email' => $this->email,
            'token' => $this->token,
        ])->first();

        if(!$check_token){
            session()->flash('fail', 'Invalid token.');
        }else{
            User::where('email', $this->email)->update([
                'password' => Hash::make($this->new_password),
            ]);
            DB::table('password_reset_tokens')->where([
                'email' => $this->email,
            ])->delete();

            $success_token = Str::random(64);
            session()->flash('success', 'Your password has been update successfully .Login with your email
            ('.$this->email.') and your password');
            return redirect()->route('author.login', ['tkn' => $success_token, 'UEmail' => $this->email]);
        }

    }

    public function render()
    {
        return view('livewire.author-reset-form');
    }
}
