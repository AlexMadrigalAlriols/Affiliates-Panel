@extends('layouts.panel', ['section' => 'Tickets', 'shop' => $shop])
@section('content')
<div>
    <div class="title-container">
        <span class="text-white h4 py-2 px-1" style="border-bottom: 2px solid white;">
            <i class='bx bx-receipt align-middle' ></i>
            Tickets History
        </span>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <table id="tickets-datatable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Import</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td></td>
                            <td>{{ $ticket->user->fullName }} ({{$ticket->user->code}})</td>
                            <td>{{ $ticket->valueHumanString }}</td>
                            <td>{{ $ticket->created_at }}</td>
                            <td>
                                @if (!$ticket->trashed())
                                    <a class="btn btn-danger" href="{{route('dashboard.shop.panel.tickets.return', ['shop' => $shop->subdomain, 'ticket' => $ticket->id])}}">
                                        <i class='bx bx-x-circle align-middle' ></i>
                                    </a>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Returned</span>
                                @endif
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
        $('#tickets-datatable').dataTable({
            "order": [[3, 'desc']]
        });
    });
</script>
@endsection
