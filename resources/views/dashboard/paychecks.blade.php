@extends('layouts.dashboard', ['section' => 'Paychecks'])
@section('content')
<div>
    <div class="title-container">
        <span class="text-white h4 py-2 px-1" style="border-bottom: 2px solid white;">
            <i class='bx bx-money-withdraw align-middle' ></i>
            Paychecks
        </span>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <table id="paychecks-datatable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Shop</th>
                        <th>Import</th>
                        <th>Expiration Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paychecks as $paycheck)
                        <tr>
                            <td>{{ $paycheck->id }}</td>
                            <td>{{ $paycheck->shop->name }}</td>
                            <td>{{ $paycheck->valueHumanString }}</td>
                            <td>
                                {{ $paycheck->expires_at ?? '-' }}
                                @if ($paycheck->expired)
                                    <span class="badge rounded-pill text-bg-danger ms-2 align-middle">Expirated</span>
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
        $('#paychecks-datatable').dataTable({
            "order": [[0, 'desc']]
        });
    });
</script>
@endsection
