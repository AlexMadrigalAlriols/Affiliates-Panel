@extends('layouts.panel', ['section' => 'Configuration', 'shop' => $shop])
@section('content')
    <div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        {{ view('dashboard.shop.panel.configurations.menu', compact('shop', 'section')) }}
                    </div>
                    <div class="col-sm-9 p-3">
                        <div class="config-header">
                            <h5 class="d-inline-block"><i class='bx bx-notepad'></i> Action Logs</h5>
                        </div>
                        <hr>
                        <table id="logs-datatable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Message</th>
                                    <th>Author</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('partials.shopLogs.datatable', ['shopLogs' => $shop->shopLogs])
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#logs-datatable').dataTable({
            "order": [[0, 'desc']]
        });

    });
</script>
@endsection
