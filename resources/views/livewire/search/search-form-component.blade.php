
<div class="col-sm-6 mt-2 mt-md-0">
    <div class="search-form">

        <form wire:submit="pursuit">
            <div class="input-group">
                <input type="text" class="form-control"
                       wire:model.live.debounce.500ms="search" placeholder="Searching..."
                       aria-label="Searching..." aria-describedby="button-search">
                <button class="btn btn-outline-warning @if(!$search) disabled @endif" type="submit" id="button-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            @if($search)
                <span class="search-empty" x-on:click="$wire.search = ''; $wire.$refresh()">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            @endif
        </form>
        @if(count($searchResults))
            <ul class="search-results">
                @foreach($searchResults as $product)
                    <li><a wire:navigate href="{{ route('product', $product->slug) }}">
                            <span>{{ $product->title }}</span>
                            <span>{{ $product->price }}</span></a>
                    </li>
                @endforeach
            </ul>
        @endif

    </div>
</div>
