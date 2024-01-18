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
            <table id="memebers-datatable" class="table table-striped table-hover">
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
                    @foreach ($shop->shopTicketHistory as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->user->fullName }} ({{$ticket->user->code}})</td>
                            <td>{{ $ticket->import }} €</td>
                            <td>{{ $ticket->created_at }}</td>
                            <td>
                                <button class="btn btn-danger"><i class='bx bx-x-circle align-middle' ></i></button>
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
        new DataTable('#memebers-datatable');
    });
</script>
@endsection
