@extends('layouts.panel', ['section' => 'Tickets', 'shop' => $shop])
@section('content')
    <div>
        <div class="card">
            <div class="card-body p-4">
                <div class="title-container">
                    <span class="h4 py-2 px-1 border-dark border-bottom border-2">
                        <i class='bx bx-receipt align-middle'></i>
                        {{ __('cruds.tickets.title_long') }}
                    </span>

                    <div class="pull-right">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class='bx bx-plus'></i>
                            {{ __('global.create')}} {{ __('cruds.tickets.title_singular') }}
                        </button>
                    </div>
                </div>

                <table id="tickets-datatable" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('cruds.tickets.fields.client') }}</th>
                            <th>{{ $shop->type === 'level' ? __('cruds.tickets.fields.import') : __('cruds.tickets.fields.items') }}</th>
                            <th>{{ __('cruds.tickets.fields.created_at') }}</th>
                            <th>{{ __('global.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td></td>
                                <td>{{ $ticket->user->fullName }} ({{ $ticket->user->code }})</td>
                                <td>{{ $shop->type === 'level' ? $ticket->valueHumanString : $ticket->valueHumanRounded }}
                                </td>
                                <td>{{ $ticket->created_at }}</td>
                                <td>
                                    @if (!$ticket->trashed())
                                        <a class="btn btn-danger"
                                            href="{{ route('dashboard.shop.panel.tickets.return', ['shop' => $shop->subdomain, 'ticket' => $ticket->id]) }}">
                                            <i class='bx bx-x-circle align-middle'></i>
                                        </a>
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">{{ __('cruds.tickets.fields.returned') }}</span>
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
            $('#tickets-datatable').dataTable({
                "order": [
                    [3, 'desc']
                ]
            });

            $("#select-user-button").click(function() {
                const user_id = $('#user-select').val();

                if (user_id) {
                    var url =
                        '{{ route('dashboard.user.scan.qr', ['shop' => ':shop_id', 'user' => ':user_id']) }}';
                    url = url.replace(':user_id', user_id);
                    window.location.href = url.replace(':shop_id', '{{ $shop->subdomain }}');
                }
            });
        });
    </script>
@endsection
