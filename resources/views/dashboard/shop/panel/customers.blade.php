@extends('layouts.panel', ['section' => 'Customers', 'shop' => $shop])
@section('content')
<div>
    <div class="title-container">
        <span class="text-white h4 py-2 px-1" style="border-bottom: 2px solid white;">
            <i class='bx bx-user align-middle' ></i>
            Customers
        </span>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <table id="customers-datatable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shop->shopCustomers as $customer)
                        <tr>
                            <td>{{ $customer->code }}</td>
                            <td>{{ $customer->fullName }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->getLevelOnShop($shop) }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('dashboard.user.scan.qr', ['shop' => $shop->subdomain, 'user' => $customer->id])}}">
                                    <i class='bx bx-receipt align-middle'></i>
                                </a>
                                <a class="btn btn-success" href="{{route('dashboard.shop.panel.paychecks.create', ['shop' => $shop->subdomain, 'user' => $customer->id])}}">
                                    <i class='bx bx-money-withdraw align-middle'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        new DataTable('#customers-datatable');
    });
</script>
@endsection
