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
                        <li><span>Checkout</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">

        @if($cart = \App\Helpers\Cart\Cart::getCart())

            <div class="row">

                <div class="col-lg-8 mb-3">
                    <div class="Checkout p-3 h-100 bg-white">

                        <h1 class="section-title h5"><span>Checkout</span></h1>

                        <form wire:submit="saveOrder">

                            @guest

                                <div class="mb-3">
                                    <label for="name" class="form-label required">Name</label>
                                    <input type="text" id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="John Doe" aria-label="Name" wire:model="name">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label required">Email</label>
                                    <input type="email" id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="johndoe@mail.com" aria-label="Name" wire:model="email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            @endguest

                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control @error('note') is-invalid @enderror" id="note"
                                          rows="5"
                                          placeholder="Note to order..." wire:model="note"></textarea>
                                @error('note')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-warning">
                                    Checkout
                                    <div wire:loading wire:target="saveOrder">
                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

                <div class="col-lg-4 mb-3">

                    <div class="cart-summary p-3 sidebar">
                        <h5 class="section-title"><span>Cart Summary</span></h5>

                        <ul class="list-unstyled">
                            @foreach($cart as $k => $item)

                                <li wire:key="{{ $k }}" class="d-flex justify-content-between my-3">
                                    <span class="fw-medium">{{ $item['title'] }}</span>
                                    <span>{{ $item['quantity'] }} x {{ $item['price'] }}</span>
                                </li>

                            @endforeach
                        </ul>

                        <div class="d-flex justify-content-between pt-3 border-top">
                            <h3>Total</h3>
                            <h3>${{ \App\Helpers\Cart\Cart::getCartTotal() }}</h3>
                        </div>

                    </div>

                </div>

            </div>
        @else
            <p>Cart is empty...</p>
        @endif
    </div>

</div>
