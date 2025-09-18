<div class="row">

    <div class="col-12 mb-4 position-relative">

        <div class="update-loading" wire:loading>
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary" wire:navigate>Add User</a>
            </div>

            <div class="card-header py-3">
                Users List
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Admin</th>
                            <th>Email</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr wire:key="{{ $user->id }}">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="btn btn-info btn-circle" wire:navigate>
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @if(auth()->id() != $user->id)
                                        <button class="btn btn-danger btn-circle"
                                                wire:click="deleteUser({{ $user->id }})"
                                                wire:confirm="Are you sure?" wire:loading.attr="disabled">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}

                </div>
            </div>
        </div>

    </div>

</div>
