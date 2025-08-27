<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class RegisterComponent extends Component
{
    public string $name;
    public string $email;
    public string $password;

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $user = User::query()
            ->create($validated);
        session()->flash('success', 'Thanks for registration!');
        $this->redirectRoute('login', navigate: true);
    }

    public function render()
    {
        return view('livewire.user.register-component', [
            'title' => 'Register Page',
        ]);
    }
}
