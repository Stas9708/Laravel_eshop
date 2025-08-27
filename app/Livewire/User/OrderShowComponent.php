<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;

class OrderShowComponent extends Component
{
    public int $id;
    public int $orderCount;


    public function mount($id, $orderCount)
    {
        $this->id = $id;
        $this->orderCount = $orderCount;
    }

    public function render()
    {
        $order = Order::query()
            ->where('user_id', '=', auth()->id())
            ->where('id', '=', $this->id)
            ->firstOrFail();
        return view('livewire.user.order-show-component', [
            'order' => $order,
            'orderCount' => $this->orderCount,
            'title' => "Order #{$this->orderCount}",
        ]);
    }
}
