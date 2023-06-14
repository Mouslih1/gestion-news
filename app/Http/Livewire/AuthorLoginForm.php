<?php

namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;



class AuthorLoginForm extends Component
{
    public $login_id, $password;
    public $returnUrl;

    public function mount()
    {
        $this->returnUrl = request()->returnUrl;
    }
    public function loginHandler()
    {
       /* $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5',
        ],[
            'email.required' => 'Enter your email address',
            'email.email' => 'Invalid email address',
            'email.exists' => 'This email is not registered in database',
            'password.required' => 'Password is required',
        ]);

        $crads = array('email' => $this->email, 'password' => $this->password);
        if(Auth::guard('web')->attempt($crads))
        {
            $checkUser = User::where('email', $this->email)->first();
            if($checkUser->blocked)
            {
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Your account has been blocked');
            }else{
                return redirect()->route('author.home');
            }
        }else{
            session()->flash('fail', 'Incorrect email or password !');
        }*/
        $fieldtype = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if($fieldtype == 'email')
        {
            $this->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' =>'required|min:5',
            ],[
                'login_id.required' => 'Email or username is required',
                'login_id.email' => 'Invalid email address',
                'login_id.exists' => 'This email is not registered in database',
                'password.required' => 'Password is required',
            ]);
        }else{
            $this->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5',
            ],[
                'login_id.required' =>'Email or username is required',
                'login_id.exists' => 'This username is not registered in database',
                'password.required' => 'Password is required',
            ]);
        }

        $crads = array($fieldtype => $this->login_id, 'password' => $this->password);
        if(Auth::guard('web')->attempt($crads)){
            $checkUser = User::where($fieldtype, $this->login_id)->first();
            if($checkUser->blocked == 1){
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Your account has been blocked');
            }else{
                if($this->returnUrl != null)
                {
                    return redirect()->to($this->returnUrl);
                }else{
                    return redirect()->route('author.home');
                }
            }
        }else{
            session()->flash('fail', 'Incorrect Email/username or password !');
        }
    }

    public function render()
    {
        return view('livewire.author-login-form');
    }

}
