<div>

    @section('metatags')
        <title>{{ config('app.name') .  '::'  . ($title ?? 'Page Title') }}</title>
        <meta name="description" content="{{ $desc ?? '' }}">
    @endsection

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs">
                    <ul>
                        <li><a wire:navigate href="{{ route('home') }}">Home</a></li>
                        <li><a wire:navigate href="{{ route('account') }}">Account</a></li>
                        <li><a wire:navigate href="{{ route('orders') }}">Orders</a></li>
                        <li><span>Order</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container position-relative">

        <div class="update-loading" wire:loading>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="row">

            <div class="col-12 mb-3">
                <div class="cart-content p-3 h-100 bg-white">
                    <h5 class="section-title"><span>Order #{{ $orderCount }}</span></h5>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderProducts as $product)
                                <tr wire:key="{{ $product->id }}">
                                    <td style="width: 150px;"><img src="{{ asset($product->image) }}" alt=""
                                                                   class="w-100"></td>
                                    <td><a href="{{ route('product', $product->slug) }}"
                                           wire:navigate>{{ $product->title }}</a></td>
                                    <td>${{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>${{ $product->price * $product->quantity }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="5" class="text-end">Total: ${{ $order->total }}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    @if($order->note)
                        <p><strong>Note:</strong> {{ $order->note }}</p>
                    @endif

                </div>
            </div>

        </div>
    </div>

</div>


