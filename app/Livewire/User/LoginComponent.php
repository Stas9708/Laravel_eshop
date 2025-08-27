<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public string $email;
    public string $password;


    public function login()
    {
        $validated = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($validated)) {
            session()->flash('success', 'You are logged in!');
            $this->redirectRoute('account', navigate: true);
        } else {
            $this->js("toastr.error('Login failed!')");
            $this->reset();
        }
    }

    public function render()
    {
        return view('livewire.user.login-component', [
            'title' => 'Login Page',
        ]);
    }
}
