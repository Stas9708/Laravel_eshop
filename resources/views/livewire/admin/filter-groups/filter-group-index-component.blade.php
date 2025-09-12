<div class="row">

    <div class="col-12 mb-4 position-relative">

        <div class="update-loading" wire:loading>
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.filter-groups.create') }}" class="btn btn-primary" wire:navigate>
                    Add filter group</a>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($filterGroups as $filterGroup)
                            <tr wire:key="{{ $filterGroup->id }}">
                                <td>{{ $filterGroup->id }}</td>
                                <td>{{ $filterGroup->title }}</td>
                                <td>
                                    <a href="{{ route('admin.filter-groups.edit', $filterGroup->id) }}"
                                       class="btn btn-warning btn-circle" wire:navigate>
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger btn-circle"
                                            wire:click="deleteFilterGroup({{ $filterGroup->id }})"
                                            wire:confirm="Are you sure?" wire:loading.attr="disabled">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

</div>
