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
                        @foreach($breadcrumbs as $breadcrumb_slug => $breadcrumb_title)
                            <li><a href="{{ route('category', $breadcrumb_slug) }}"
                                   wire:navigate>{{ $breadcrumb_title }}</a></li>
                        @endforeach
                        <li><span>{{ $product->title }}</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-4 mb-3">
                <div class="bg-white h-100">
                    <div id="carouselExampleFade" class="carousel carousel-dark slide carousel-fade">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset($product->getImage()) }}" class="d-block w-100" alt="...">
                            </div>

                            @foreach($product->gallery as $img)
                                <div class="carousel-item active">
                                    <img src="{{ asset($img) }}" class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                        @if($product->gallery)
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-lg-8 mb-3">
                <div class="bg-white product-content p-3 h-100">
                    <h1 class="section-title h3"><span>{{ $product->title }}</span></h1>

                    <div class="product-price">
                        @if($product->old_price)
                            <small>{{ $product->old_price }}</small>
                        @endif
                        {{ $product->price }}
                    </div>

                    <p>{{ $product->excerpt }}</p>

                    <div class="product-add2cart">
                        <div class="input-group">
                            <input type="number" class="form-control" value="{{ $quantity }}"
                                   wire:model="quantity" min="1">
                            <button class="btn btn-warning" wire:click="add2Cart({{ $product->id }}, true)"
                                    wire:loading.attr="disabled">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Add to cart</span>
                                <div wire:loading wire:target="add2Cart({{ $product->id }}, true)">
                                    <div class="spinner-grow spinner-grow-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-4 mb-2">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fa-solid fa-shield-halved"></i> Гарантия
                                    </h5>
                                    <ul class="list-unstyled">
                                        <li>Гарантия 1 год</li>
                                        <li>Возвращение товара в течение 14 дней</li>
                                        <li>Гарантия качества</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-2">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fa-solid fa-truck-fast"></i> Доставка</h5>
                                    <ul class="list-unstyled">
                                        <li>Доставка по всей стране</li>
                                        <li>Доставка почтой</li>
                                        <li>Самовывоз</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-2">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fa-regular fa-credit-card"></i> Оплата</h5>
                                    <ul class="list-unstyled">
                                        <li>Наличный рассчет</li>
                                        <li>Безналичный рассчет</li>
                                        <li>VISA/MasterCard</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="product-content-details bg-white p-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                    data-bs-target="#description-tab-pane" type="button" role="tab"
                                    aria-controls="description-tab-pane" aria-selected="true">Description
                            </button>
                        </li>
                        @if($attributes->isNotEmpty())
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="features-tab" data-bs-toggle="tab"
                                        data-bs-target="#features-tab-pane" type="button" role="tab"
                                        aria-controls="features-tab-pane" aria-selected="false">Features
                                </button>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel"
                             aria-labelledby="description-tab" tabindex="0">
                            {!! $product->content !!}
                        </div>
                        @if($attributes->isNotEmpty())
                            <div class="tab-pane fade" id="features-tab-pane" role="tabpanel"
                                 aria-labelledby="features-tab" tabindex="0">
                                <table class="table">
                                    <tbody>
                                    @foreach($attributes as $attr)
                                        <tr>
                                            <th scope="row">{{ $attr->filter_groups_title }}</th>
                                            <td>{{ $attr->filters_title }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(count($relatedProducts))
        <section class="new-products">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="section-title">
                        <span>Related products</span>
                    </h2>
                </div>
            </div>

            <div class="owl-carousel owl-theme owl-carousel-full" wire:ignore>
                @foreach($relatedProducts as $product)
                    <div wire:key="{{ $product->id }}">
                        @include('incs.product-card')
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
