<?php

namespace App\Helpers\Cart;

use App\Models\Product;

class Cart
{

    public static function add2Cart(int $productId, int $quantity = 1): bool
    {
        $added = false;

        if (self::hasProductInCart($productId)) {
            session(["cart.{$productId}.quantity" => session("cart.{$productId}.quantity") + $quantity]);
            $added = true;
        } else {
            $product = Product::query()->find($productId);
            if ($product) {
                $new_product = [
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'image' => $product->getImage(),
                    'price' => $product->price,
                    'quantity' => $quantity,
                ];
                session(["cart.{$productId}" => $new_product]);
                $added = true;
            }
        }
        return $added;
    }

    public static function removeProductFromCart(int $productId): bool
    {
        if (self::hasProductInCart($productId)) {
            session()->forget("cart.{$productId}");
            return true;
        }
        return false;
    }

    public static function getCart(): array
    {
        return session('cart') ?: [];
    }

    public static function getCartTotal(): int
    {
        $total = 0;
        $cart = self::getCart();
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public static function getCartQuantityItems(): int
    {
        return count(self::getCart());
    }

    public static function getCartQuantityTotal(): int
    {
        $cart = self::getCart();
        return array_sum(array_column($cart, 'quantity'));
    }

    public static function hasProductInCart(int $productId): bool
    {
        return session()->has("cart.$productId");
    }

    public static function updateItemQuanity(int $productId, int $qty): bool
    {
        $updated = false;
        if (self::hasProductInCart($productId)) {
            session(["cart.{$productId}.quantity" => $qty]);
            $updated = true;
        }
        return $updated;
    }

    public static function clearCart()
    {
        session()->forget("cart");
    }


}
