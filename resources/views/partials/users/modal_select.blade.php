<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="roleModalLabel">
                    <i class='bx bxs-user-plus align-middle'></i>
                    {{ __('global.select') }} {{ __('cruds.users.title_singular') }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body">
                <form id="frm-role">
                    <div class="mb-3">
                        <label for="user-select">{{ __('cruds.vouchers.fields.user') }}</label>
                        <select name="user_id" id="user-select" class="select2" required>
                            <option value="">{{ __('global.select_one') }}</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class='bx bx-x align-middle'></i> {{ __('global.close') }}
                </button>
                <button type="button" class="btn btn-success" id="select-user-button">
                    <i class='bx bx-check'></i> {{ __('global.select') }}
                </button>
            </div>
        </div>
    </div>
</div>
