<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ordersCnt }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-list-ol fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Orders Total Sum</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ \Illuminate\Support\Number::currency($ordersTotal) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-dollar-sign fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Products
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $productsCnt }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-table-list fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $usersCnt }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-people-group fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
