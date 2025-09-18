<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Create User')]
class UserCreateComponent extends Component
{
    public $name;
    public $is_admin = false;
    public $email;
    public $password;


    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|max:255',
            'is_admin' => 'boolean',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];
        $user->is_admin = $validated['is_admin'];
        $user->save();
        session()->flash('success', 'User created successfully.');
        $this->redirectRoute('admin.users.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.user.user-create-component');
    }
}
