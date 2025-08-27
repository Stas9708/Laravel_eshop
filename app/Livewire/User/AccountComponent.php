<?php

namespace App\Livewire\User;

use Livewire\Component;

class AccountComponent extends Component
{
    public function render()
    {
        return view('livewire.user.account-component', [
            'title' => 'Account Page',
            ]);
    }
}
