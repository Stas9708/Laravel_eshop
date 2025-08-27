<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Dashboard')]
class HomeComponent extends Component
{
    public function render()
    {
        $productsCnt = Product::query()
            ->count();
        $usersCnt = User::query()
            ->count();
        $ordersCnt = Order::query()
            ->count();
        $ordersTotal = Order::query()
            ->sum('total');
        return view('livewire.admin.home-component', [
            'productsCnt' => $productsCnt,
            'usersCnt' => $usersCnt,
            'ordersCnt' => $ordersCnt,
            'ordersTotal' => $ordersTotal,
        ]);
    }
}
