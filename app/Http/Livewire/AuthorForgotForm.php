<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthorForgotForm extends Component
{
    public $email;

    public function forgotHandler(){
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ],[
            'email.required' => 'This :attribute is required',
            'email.email' => 'Invalid email address',
            'email.exists' => 'This :attribute is not registered ',
        ]);

        $token = base64_encode(Str::random(64));
        DB::table('password_reset_tokens')->insert([
            'email' => $this->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $user = User::where('email' , $this->email)->first();
        $link = route('author.reset_form', ['token' => $token, 'email' => $this->email]);

        $data = array(
            'name' => $user->name,
            'email' => $this->email,
            'link' => $link,
        );

        Mail::send('forgot-email-template', $data, function($message) use ($user){
            $message->from('newsZ@gmail.com', 'newZ');
            $message->to($user->email, $user->name)->subject('Reset password');
        });
       /* $mail_body = view('forgot-email-template', $data)->render();
        $mailConfig = array(
            'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
            'mail_from_name' => env('EMAIL_FROM_NAME'),
            'mail_recipient_email' => $user->email,
            'mail_recipient_name' => $user->name,
            'mail_subject' => 'Reset Password',
            'mail_body' => $mail_body
        );

        send_email($mailConfig);*/

        $this->email = null;
        session()->flash('success', 'We have e-mailed your password reset link');
    }

    public function render()
    {
        return view('livewire.author-forgot-form');
    }















































































































      /*
      ------------------------------------------------------------------------------------------------------
        $body_message = "We are received a request to reset the password for <b>newsZ</b> account associated
        with ".$this->email.".<br> You can reset your password by clicking the button below.";
        $body_message.="<br>";
        $body_message.='<a href="'.$link.'" target="_blank" style="background-color: #4CAF50;border: none;
        color: white;padding: 12px 24px;text-align: center;text-decoration: none;display: inline-block;
        font-size: 16px;border-radius: 4px;cursor: pointer;" >Reset Password</a>';
        $body_message.='<br>';
        $body_message.='if you did not request for a password reset, please ignore this email';
      ------------------------------------------------------------------------------------------------------
    */
}
