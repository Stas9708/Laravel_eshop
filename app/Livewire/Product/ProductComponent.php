<?php

namespace App\Livewire\Product;

use App\Helpers\Category\Category;
use App\Helpers\Traits\CartTrait;
use App\Models\FilterGroup;
use App\Models\Product;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class ProductComponent extends Component
{
    use CartTrait, WithPagination;

    public string $slug = '';
    public $activeTab = null;


    public function updatingPage()
    {
        $this->activeTab = 'reviews';
    }

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $product = Product::query()
            ->where('slug', '=' ,$this->slug)
            ->firstOrFail();
        $relatedProducts = Product::query()
            ->where('category_id', '=', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(8)
            ->get();
        $breadcrumbs = Category::getBreadcrumbs($product->category_id);
        $attributes = FilterGroup::query()
            ->selectRaw('filter_groups.title as filter_groups_title,
            GROUP_CONCAT(filters.title SEPARATOR ", ")
             as filters_title')
            ->join('filters', 'filters.filter_group_id', '=', 'filter_groups.id')
            ->join('filter_products', 'filter_products.filter_id', '=', 'filters.id')
            ->where('filter_products.product_id', '=' ,$product->id)
            ->groupBy('filter_groups.title')
            ->get();
        $reviews = Review::query()
            ->where('product_id', '=', $product->id)
            ->orderByDesc('created_at')
            ->paginate();
        $productRating = Review::query()
            ->where('product_id', '=', $product->id)
            ->avg('rating');
        return view('livewire.product.product-component', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'breadcrumbs' => $breadcrumbs,
            'attributes' => $attributes,
            'title' => "Product - {$product->title}",
            'reviews' => $reviews,
            'productRating' => $productRating,
        ]);
    }
}
