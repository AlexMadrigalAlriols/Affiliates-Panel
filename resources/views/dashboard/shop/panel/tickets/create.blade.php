@extends('layouts.panel', ['section' => 'Create Ticket', 'shop' => $shop])
@section('content')
<div>
    <div class="title-container">
        <span class="text-white h4 py-2 px-1" style="border-bottom: 2px solid white;">
            <i class='bx bx-receipt align-middle' ></i>
            Create Ticket
        </span>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <form id="frm-ticket" method="POST">
                @csrf
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="h5"><b>Customer</b></p>
                        <p>
                            Name: {{ $user->fullName }} <br/>
                            Email: {{ $user->email }} <br>
                            Code: {{ $user->code }}
                        </p>
                    </div>
                </div>
                <h6><b>Ticket Import</b> <label class="required">*</label></h6>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" name="import" id="ticket_import" value="1" min="0" placeholder="1" autofocus required step="0.01">
                    <label for="ticket_import">Import</label>
                </div>

                <button class="btn btn-success pull-right w-100"><i class='bx bx-save'></i> Create Ticket</button>
            </form>
        </div>
    </div>
</div>
@endsection
