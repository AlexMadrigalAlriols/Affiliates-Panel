@extends('layouts.panel', ['section' => 'users', 'shop' => $shop])
@section('content')
    <div>
        <div class="card">
            <div class="card-body p-4">
                <div class="title-container">
                    <span class=" h4 py-2 px-1 border-dark border-bottom border-2">
                        <i class='bx bx-user align-middle'></i>
                        {{ __('cruds.users.title') }}
                    </span>
                </div>
                <div>
                    <table id="customers-datatable" class="table table-striped table-hover nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('cruds.users.fields.name') }}</th>
                                <th>{{ __('cruds.users.fields.email') }}</th>
                                <th>{{ __('cruds.users.fields.phone') }}</th>
                                @if ($shop->type === 'level')
                                    <th>{{ __('cruds.users.fields.level') }}</th>
                                @endif
                                <th>{{ __('global.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shop->shopCustomers as $customer)
                                <tr>
                                    <td>{{ $customer->code }}</td>
                                    <td>{{ $customer->fullName }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    @if ($shop->type === 'level')
                                        <td>{{ $customer->getLevelOnShop($shop) }}</td>
                                    @endif
                                    <td>
                                        <a class="btn btn-primary mb-1"
                                            href="{{ route('dashboard.user.scan.qr', ['shop' => $shop->subdomain, 'user' => $customer->id]) }}">
                                            <i class='bx bx-receipt align-middle'></i>
                                        </a>
                                        <a class="btn btn-success mb-1"
                                            href="{{ route('dashboard.shop.panel.paychecks.create', ['shop' => $shop->subdomain, 'user' => $customer->id]) }}">
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
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            new DataTable('#customers-datatable', {
                scrollX: true
            });
        });
    </script>
@endsection
