<?php

namespace App\Livewire\Search;

use App\Models\Product;
use Livewire\Component;

class SearchFormComponent extends Component
{
    public string $search = '';

    public function render()
    {
        $searchResults = [];
        if (mb_strlen($this->search, 'UTF-8') > 0) {
            $searchResults = Product::query()
                ->whereLike('title', '%' . $this->search . '%')
                ->limit(10)
                ->get();

        }
        return view('livewire.search.search-form-component', [
            'searchResults' =>  $searchResults,
        ]);
    }

    public function pursuit()
    {
        if ($this->search) {
            $this->redirectRoute('search', ['query' => $this->search], navigate: true);
        }
    }
}
