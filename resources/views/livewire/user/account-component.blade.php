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

    <div class="container">


        <div class="row">

            <div class="col-lg-4 mb-3">
                <div class="cart-summary p-3 sidebar">
                    <h5 class="section-title"><span>Links</span></h5>
                    @include('incs.account-links')
                </div>
            </div>

            <div class="col-lg-8 mb-3">
                <div class="cart-content p-3 h-100 bg-white">
                    <p>Welcome, {{ auth()->user()->name }}!</p>

                    @include('incs.account-links')
                </div>
            </div>

        </div>
    </div>

</div>
