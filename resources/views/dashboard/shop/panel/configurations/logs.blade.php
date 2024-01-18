<div class="config-header">
    <h5 class="d-inline-block"><i class='bx bx-notepad'></i> Action Logs</h5>
    <button class="btn btn-success pull-right" id="refreshTableBtn" type="button"><i class='bx bx-refresh'></i></button>
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
