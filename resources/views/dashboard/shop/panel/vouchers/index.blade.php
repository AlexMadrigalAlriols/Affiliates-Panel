@extends('layouts.panel', ['section' => 'Vouchers', 'shop' => $shop])
@section('content')
    <div>
        <div class="card">
            <div class="card-body p-4">
                <div class="title-container">
                    <span class="h4 py-2 px-1 border-dark border-bottom border-2">
                        <i class='bx bx-money-withdraw align-middle'></i>
                        {{ __('cruds.vouchers.title') }}
                    </span>

                    @can('hasPermissionInShop', [$permission . 'create', $shop->id])
                        <div class="pull-right">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#userModal">
                                <i class='bx bx-plus'></i>
                                {{ __('global.create')}} {{ __('cruds.vouchers.title_singular') }}
                            </button>
                        </div>
                    @endcan
                </div>
                <table id="vouchers-datatable" class="table table-striped table-hover nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('cruds.vouchers.fields.user') }}</th>
                            <th>{{ __('cruds.vouchers.fields.reward') }}</th>
                            <th>{{ __('cruds.vouchers.fields.expiration_date') }}</th>
                            <th>{{ __('global.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $voucher)
                            <tr>
                                <td>{{ $voucher->id }}</td>
                                <td>{{ $voucher->user->fullName }} ({{ $voucher->user->code }})</td>
                                <td>{{ $voucher->reward }}</td>
                                <td>{{ $voucher->expires_at ?? '-' }}</td>
                                <td>
                                    @if (!$voucher->expired)
                                        @can('hasPermissionInShop', [$permission . 'delete', $shop->id])
                                            <a class="btn btn-success"
                                                href="{{ route('dashboard.shop.panel.voucher.use', ['shop' => $shop->subdomain, 'voucher' => $voucher->id]) }}">
                                                <i class='bx bx-check-circle align-middle'></i>
                                            </a>
                                        @endcan
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">{{ __('global.expired') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('partials.users.modal_select')
@endsection

@section('scripts')
    @parent
    @include('partials.users.select2_script')
    <script>
        $(document).ready(function() {
            $('#vouchers-datatable').dataTable({
                "scrollX": true,
                "order": [
                    [4, 'asc']
                ]
            });

            $("#select-user-button").click(function() {
                const user_id = $('#user-select').val();

                if (user_id) {
                    var url =
                        '{{ route('dashboard.shop.panel.voucher.create', ['shop' => ':shop_id', 'user' => ':user_id']) }}';
                    url = url.replace(':user_id', user_id);
                    window.location.href = url.replace(':shop_id', '{{ $shop->subdomain }}');
                }
            });
        });
    </script>
@endsection
