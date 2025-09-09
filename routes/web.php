<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\HomeComponent::class)->name('home');
Route::get('/category/{slug}', \App\Livewire\Product\CategoryComponent::class)->name('category');
Route::get('/product/{slug}', \App\Livewire\Product\ProductComponent::class)->name('product');
Route::get('/cart', \App\Livewire\Cart\Cart::class)->name('cart');
Route::get('/checkout', \App\Livewire\Cart\CheckoutComponent::class)->name('checkout');
Route::get('/search', \App\Livewire\Search\SearchComponent::class)->name('search');


Route::middleware('guest')->group(function () {
    Route::get('/register', \App\Livewire\User\RegisterComponent::class)->name('register');
    Route::get('/login', \App\Livewire\User\LoginComponent::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', function (){
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
    Route::get('/account', \App\Livewire\User\AccountComponent::class)->name('account');
    Route::get('/change-account', \App\Livewire\User\ChangeAccountComponent::class)->name('change-account');
    Route::get('/order-show/{id}/{orderCount}', \App\Livewire\User\OrderShowComponent::class)->name('orders-show');
    Route::get('/order', \App\Livewire\User\OrderComponent::class)->name('orders');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', \App\Livewire\Admin\HomeComponent::class)->name('admin');

    Route::get('/categories', \App\Livewire\Admin\Category\CategoryIndexComponent::class)
        ->name('admin.categories.index');
    Route::get('/categories/create', \App\Livewire\Admin\Category\CategoryCreateComponent::class)
        ->name('admin.categories.create');
    Route::get('/categories/{category}/edit', \App\Livewire\Admin\Category\CategoryEditComponent::class)
        ->name('admin.categories.edit');

    Route::get('/products', \App\Livewire\Admin\Product\ProductIndexComponent::class)
        ->name('admin.products.index');
    Route::get('/products/create', \App\Livewire\Admin\Product\ProductCreateComponent::class)
        ->name('admin.products.create');
    Route::get('/products/{product}/edit', \App\Livewire\Admin\Product\ProductEditComponent::class)
        ->name('admin.products.edit');
});
