<div class="modal-header">
    <h1 class="modal-title fs-5" id="roleModalLabel">
        <i class='bx bxs-user-plus align-middle'></i>
        @if ($shopRole->id)
            Edit Role
        @else
            Add Role
        @endif
    </h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body" id="modal-body">
    <form action="" id="frm-role">
        @csrf
        <div class="mb-3">
            <label for="user-select">User</label>
            <select name="user_id" id="user-select" class="form-select">
                <option value="">Choose one...</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{($shopRole->user_id === $user->id ? 'selected' : '')}}>{{ ucfirst($user->full_name) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-floating mb-2">
            <select class="form-select" name="role" id="role-select" aria-label="Shop Role">
                <option selected>Choose a member role</option>
                @foreach ($roles as $role)
                    <option value="{{$role}}" {{($shopRole->role === $role ? 'selected' : '')}}>{{ ucfirst($role) }}</option>
                @endforeach
            </select>
            <label for="floatingSelect">Role</label>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
        <i class='bx bx-x align-middle'></i> Close
    </button>
    @if ($shopRole->id)
        <button type="button" class="btn btn-success" id="save-member-role-button" data-id="{{ $shopRole->id }}">
            <i class='bx bx-save'></i> Save
        </button>
    @else
        <button type="button" class="btn btn-success" id="add-member-role-button">
            <i class='bx bx-save'></i> Add
        </button>
    @endif
</div>
