<?php

namespace App\Livewire\Search;

use App\Helpers\Traits\CartTrait;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination, CartTrait;

    public $query;

    public function mount()
    {
        $this->query = request()->query('query') ?? '';
    }

    public function render()
    {
        $products = [];
        if ($this->query) {
            $products = Product::query()
                ->whereLike('title', '%' . $this->query . '%')
                ->paginate(10);
        }
        return view('livewire.search.search-component', [
            'products' => $products,
            'title' => 'Search Results',
        ]);
    }
}
