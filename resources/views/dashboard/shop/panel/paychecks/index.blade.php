@extends('layouts.panel', ['section' => 'Paychecks', 'shop' => $shop])
@section('content')
    <div>
        <div class="card">
            <div class="card-body p-4">
                <div class="title-container">
                    <span class="h4 py-2 px-1 border-dark border-bottom border-2">
                        <i class='bx bx-money-withdraw align-middle'></i>
                        {{ __('cruds.paychecks.title') }}
                    </span>

                    <div class="pull-right">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class='bx bx-plus'></i>
                            {{ __('global.create')}} {{ __('cruds.paychecks.title_singular') }}
                        </button>
                    </div>
                </div>
                <table id="paychecks-datatable" class="table table-striped table-hover nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('cruds.paychecks.fields.user') }}</th>
                            <th>{{ __('cruds.paychecks.fields.import') }}</th>
                            <th>{{ __('cruds.paychecks.fields.expiration_date') }}</th>
                            <th>{{ __('global.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paychecks as $paycheck)
                            <tr>
                                <td>{{ $paycheck->id }}</td>
                                <td>{{ $paycheck->user->fullName }} ({{ $paycheck->user->code }})</td>
                                <td>{{ $paycheck->valueHumanString }}</td>
                                <td>{{ $paycheck->expires_at ?? '-' }}</td>
                                <td>
                                    @if (!$paycheck->expired)
                                        <a class="btn btn-success"
                                            href="{{ route('dashboard.shop.panel.paychecks.destroy', ['shop' => $shop->subdomain, 'paycheck' => $paycheck->id]) }}">
                                            <i class='bx bx-check-circle align-middle'></i>
                                        </a>
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">Expired</span>
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
            $('#paychecks-datatable').dataTable({
                "scrollX": true,
                "order": [
                    [4, 'asc']
                ]
            });

            $("#select-user-button").click(function() {
                const user_id = $('#user-select').val();

                if (user_id) {
                    var url =
                        '{{ route('dashboard.shop.panel.paychecks.create', ['shop' => ':shop_id', 'user' => ':user_id']) }}';
                    url = url.replace(':user_id', user_id);
                    window.location.href = url.replace(':shop_id', '{{ $shop->subdomain }}');
                }
            });
        });
    </script>
@endsection
