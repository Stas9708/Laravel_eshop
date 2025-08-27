<div class="row">

    <div class="col-12 mb-4">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" wire:navigate>Add Category</a>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10%;">ID</th>
                            <th style="width: 70%;">Title</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        {!! \App\Helpers\Category\Category::getMenu('incs.menu-table-tpl') !!}
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

    </div>

</div>
