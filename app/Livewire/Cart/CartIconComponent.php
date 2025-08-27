<?php

namespace App\Livewire\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class CartIconComponent extends Component
{

    #[On('cart-updated')]
    public function render()
    {
        return view('livewire.cart.cart-icon-component');
    }
}
