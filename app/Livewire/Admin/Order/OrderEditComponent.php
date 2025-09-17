<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Edit Order')]
class OrderEditComponent extends Component
{
    public Order $order;
    public bool $status;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->status = $order->status;
    }

    public function updatedStatus()
    {
        $this->order->setAttribute('status', $this->status)->save();
    }

    public function render()
    {
        return view('livewire.admin.order.order-edit-component');
    }
}
