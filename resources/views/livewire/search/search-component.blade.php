<div>

    @section('metatags')
        <title>{{ config('app.name') .  '::'  . ($title ?? 'Page Title') }}</title>
        <meta name="description" content="{{ $desc ?? '' }}">
    @endsection

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs" id="products">
                    <ul>
                        <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                        <li><span>Search results</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container position-relative">

        <div class="update-loading" wire:loading wire:target.except="add2Cart">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="col-lg-12">
            <h1 class="section-title h3"><span>Search by: "{{ $query }}"</span></h1>

            @if(count($products))
                <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-3 col-sm-6 mb-3" wire:key="{{ $product->id }}">
                        @include('incs.product-card')
                    </div>
                @endforeach
            </div>
            @else
                No products found!
            @endif
            <div class="row">
                <div class="col-12">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

