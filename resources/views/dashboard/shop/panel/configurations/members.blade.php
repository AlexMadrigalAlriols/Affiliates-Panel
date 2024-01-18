<div class="config-header">
    <h5 class="d-inline-block"><i class='bx bxs-user-detail'></i> Member Roles</h5>
    <button class="btn btn-success pull-right" type="button" data-bs-toggle="modal" data-bs-target="#addRoleModal">
        <i class='bx bxs-user-plus align-middle'></i> Add Role
    </button>
</div>
<hr>
<table id="members-datatable" class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @include('partials.shopRoles.datatable', ['shopRoles' => $shop->shopRoles])
    </tbody>
</table>

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class='bx bxs-user-plus align-middle'></i> Add Role</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-role">
            <div class="mb-3">
              <label for="user-select">User</label>
              <select name="user_id" id="user-select" class="form-select select2">
                <option value="">Choose one...</option>
                <option value="test">test</option>
              </select>
            </div>

            <div class="form-floating mb-2">
              <select class="form-select" name="role" id="role-select" aria-label="Floating label select example" >
                <option selected>Choose a member role</option>
                @foreach ($roles as $role)
                  <option value="{{$role}}">{{ ucfirst($role) }}</option>
                @endforeach
              </select>
              <label for="floatingSelect">Role</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class='bx bx-x align-middle'></i> Close</button>
          <button type="button" class="btn btn-success" id="add-member-role-button"><i class='bx bx-save'></i> Add</button>
        </div>
      </div>
    </div>
  </div>
