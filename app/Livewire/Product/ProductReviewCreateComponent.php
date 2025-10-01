<?php

namespace App\Livewire\Product;

use AllowDynamicProperties;
use App\Models\Review;
use Livewire\Component;

#[AllowDynamicProperties]
class ProductReviewCreateComponent extends Component
{
    public $user_id;
    public $review;
    public $product_id;
    public $product_slug;
    public $rating = 0;

    public function mount($product_id, $product_slug)
    {
        $this->user_id = auth()->user()->id;
        $this->product_id = $product_id;
        $this->product_slug = $product_slug;
    }

    public function save()
    {
        $validated = $this->validate([
           'review' => 'required|string|max:255',
           'rating' => 'required',
        ]);
        $review = new Review();
        $review->user_id = $this->user_id;
        $review->product_id = $this->product_id;
        $review->review = $validated['review'];
        $review->rating = $validated['rating'];
        $review->save();
        session()->flash('success', 'Review was send successfully.');
        $this->redirectRoute('product', ['slug' => $this->product_slug]);
    }

    public function render()
    {
        return view('livewire.product.product-review-create-component');
    }
}
