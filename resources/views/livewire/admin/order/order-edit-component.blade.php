<div class="row">

    <div class="col-12 mb-4 position-relative">

        <div class="update-loading" wire:loading>
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                Order #{{ $order->id }} ({{ $order->status ? 'Completed' : 'New' }})
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Customer Name</th>
                            <td>{{ $order->name }}</td>
                        </tr>
                        <tr>
                            <th>Customer Email</th>
                            <td>{{ $order->email }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" wire:model.live="status">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Sum</th>
                            <td>${{ $order->total }}</td>
                        </tr>
                        <tr>
                            <th>Created</th>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Updated</th>
                            <td>{{ $order->updated_at }}</td>
                        </tr>
                        @if($order->note)
                            <tr>
                                <th>Note</th>
                                <td>{{ $order->note }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                Products to order #{{ $order->id }}
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->orderProducts as $product)
                            <tr wire:key="{{ $product->id }}">
                                <td><img src="{{ asset($product->image) }}" alt="" height="50"></td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>
