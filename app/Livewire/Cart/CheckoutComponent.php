<?php

namespace App\Livewire\Cart;

use App\Mail\OrderClient;
use App\Mail\OrderManager;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public string $name;
    public string $email;
    public string $note;

    public function mount()
    {
        $this->name = auth()->user()->name ?? '';
        $this->email = auth()->user()->email ?? '';
    }

    public function saveOrder()
    {
        $validated= $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'note' => 'string|nullable',
        ]);
        $validated = array_merge($validated, [
            'user_id' => auth()->id(),
            'total' => \App\Helpers\Cart\Cart::getCartTotal()
        ]);
        try {
            DB::beginTransaction();
            $order = Order::create($validated);
            $orderProducts = [];
            $cart = \App\Helpers\Cart\Cart::getCart();
            foreach ($cart as $productID => $product) {
                $orderProducts[] = [
                    'product_id' => $productID,
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'image' => $product['image'],
                    'slug' => $product['slug'],
                ];
            }
            $order->orderProducts()->createMany($orderProducts);
            DB::commit();
            try {
                Mail::to($validated['email'])->send(new OrderClient($orderProducts, \App\Helpers\Cart\Cart::getCartTotal(),
                    $order->id, $validated['note']));
                Mail::to('manager@mail.com')->send(new OrderManager($order->id));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
            \App\Helpers\Cart\Cart::clearCart();
            $this->dispatch('cart-updated');
            $this->js("toastr.success('Order has been saved')");

        }catch (\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Oops! Something went wrong')");
        }
    }

    public function render()
    {
        return view('livewire.cart.checkout-component', [
            'title' => 'Checkout Page',
            ]);
    }
}
