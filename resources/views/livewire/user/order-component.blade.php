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
                        <li><span>Account</span></li>
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

            <div class="col-lg-4 mb-3">
                <div class="cart-summary p-3 sidebar">
                    <h5 class="section-title"><span>Links</span></h5>
                    @include('incs.account-links')
                </div>
            </div>

            <div class="col-lg-8 mb-3">
                <div class="cart-content p-3 h-100 bg-white">
                    <h5 class="section-title"><span>Orders</span></h5>

                    @if($orders->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Updated</th>
                                    <th><i class="fa-solid fa-eye"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $cnt => $order)
                                    <tr wire:key="{{ $order->id }}">
                                        <td>{{ $orders->firstItem() + $cnt }}</td>
                                        <td>${{ $order->total }}</td>
                                        <td>{{ $order->status ? 'Completed' : 'New' }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->updated_at }}</td>
                                        <td><a href="{{ route('orders-show', [$order->id, ($orders->firstItem() + $cnt)]) }}"
                                               class="btn btn-warning"
                                               wire:navigate><i class="fa-solid fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $orders->links() }}
                    @else
                        <p>No orders...</p>
                    @endif

                </div>
            </div>

        </div>
    </div>

</div>

