<?php

namespace App\Helpers\Traits;

use App\Helpers\Cart\Cart;

trait CartTrait
{

    public $quantity = 1;

    public function add2Cart(int $productId, $quantity = false)
    {
        $quantity = $quantity ? (int)$this->quantity : 1;
        if ($quantity < 1) {
            $quantity = 1;
        }
        if (Cart::add2Cart($productId, $quantity)) {
            $this->js("toastr.success('Product added to cart successfully')");
            $this->dispatch('cart-updated');
        } else {
            $this->js("toastr.error('Oops! Something went wrong!')");
        }
    }

    public function removeFromCart(int $productId): void
    {
        if (Cart::removeProductFromCart($productId)) {
            $this->js("toastr.success('Product removed from cart successfully')");
            $this->dispatch('cart-updated');
        } else {
            $this->js("toastr.error('Oops! Something went wrong!')");
        }
    }

    public function updateItemQuanity(int $productId, int $qty)
    {
        if ($qty <= 0) {
            $qty = 1;
        }
        if (Cart::updateItemQuanity($productId, $qty)) {
            $this->dispatch('cart-updated');
            $this->js("toastr.success('Quantity updated successfully')");
        } else {
            $this->js("toastr.error('Error, Quantity not updated!')");
        }
    }

    public function clearCart()
    {
        Cart::clearCart();
        $this->dispatch('cart-updated');
        $this->js("toastr.success('Cart is cleared, successfully!')");
    }

}

