@extends('layouts.panel', ['section' => 'Messages', 'shop' => $shop])
@section('content')
<div>
    <div class="title-container">
        <span class="text-white h4 py-2 px-1" style="border-bottom: 2px solid white;">
            <i class='bx bx-mail-send align-middle' ></i>
            Announcements
        </span>

        <div class="pull-right">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#userModal">
                <i class='bx bx-plus'></i>
                Create Announcement
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <table id="messages-datatable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Body</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr>
                            <td>{{ $message->id }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>{{ $message->body }}</td>
                            <td></td>
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
        $('#messages-datatable').dataTable({
            "order": [[4, 'asc']]
        });
    });
</script>
@endsection
