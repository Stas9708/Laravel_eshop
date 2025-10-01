<div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0">
            <h5 class="mb-0"><i class="fa-solid fa-pen-to-square me-2 text-warning"></i> Write a review</h5>
        </div>

        <div class="card-body">

            <form wire:submit="save">

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" value="{{ auth()->user()->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="review" class="form-label required">Review:</label>
                    <input type="text" class="form-control @error('review') is-invalid @enderror"
                           id="review" placeholder="Product review"
                           wire:model="review">
                    @error('review')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label required">Rating:</label>
                    <div>
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa-{{ $i <= $rating ? 'solid' : 'regular' }} fa-star"
                               style="cursor: pointer; color: {{ $i <= $rating ? 'gold' : '#ccc' }}; font-size: 1.5rem;"
                               wire:click="$set('rating', {{ $i }})">
                            </i>
                        @endfor
                    </div>
                    @error('rating')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-warning">
                        Save
                        <div wire:loading wire:target="save" class="spinner-grow spinner-grow-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
