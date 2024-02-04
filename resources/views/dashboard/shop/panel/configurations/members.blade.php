<div class="config-header">
    <h5 class="d-inline-block"><i class='bx bxs-user-detail'></i> Member Roles</h5>
    <button class="btn btn-success pull-right" type="button" id="add-member-button">
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
<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content"></div>
    </div>
</div>
