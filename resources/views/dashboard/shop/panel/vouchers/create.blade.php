@extends('layouts.panel', ['section' => 'create_voucher', 'shop' => $shop])
@section('content')
    <div>
        <div class="card">
            <div class="card-body p-4">
                <div class="title-container">
                    <span class="h4 py-2 px-1 border-dark border-bottom border-2">
                        <i class='bx bx-receipt align-middle'></i>
                        {{ __('global.create') }} {{ __('cruds.vouchers.title_singular') }}
                    </span>
                </div>

                <form id="frm-ticket" method="POST">
                    @csrf
                    <div class="card mb-4">
                        <div class="card-body">
                            <p class="h5"><b><i class='bx bx-user'></i> {{ __('cruds.users.title_singular') }}</b></p>
                            <p>
                                {{ __('cruds.users.fields.name') }}: {{ $user->fullName }} <br />
                                {{ __('cruds.users.fields.email') }}: {{ $user->email }} <br>
                                {{ __('cruds.users.fields.code') }}: {{ $user->code }}
                            </p>
                        </div>
                    </div>
                    <h6><b>{{ __('cruds.vouchers.fields.reward') }}</b> <label class="required">*</label></h6>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="reward" id="voucher_reward" placeholder="20%" autofocus required>
                        <label for="voucher_reward">{{ __('cruds.vouchers.fields.reward') }}</label>
                    </div>

                    <h6><b>{{ __('cruds.vouchers.fields.expiration_date') }}</b></h6>
                    <div class="form-floating mb-4">
                        <input type="date" class="form-control" name="expiration_date" id="expiration_date">
                        <label for="expiration_date">{{ __('cruds.vouchers.fields.expiration_date') }}</label>
                    </div>

                    <button class="btn btn-success pull-right w-100"><i class='bx bx-save'></i> {{ __('global.create') }} {{ __('cruds.vouchers.title_singular') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
