@extends('layouts.panel', ['section' => 'Configuration', 'shop' => $shop])
@section('content')
<div>
    <div class="title-container">
        <span class="text-white h4 py-2 px-1" style="border-bottom: 2px solid white;">
            <i class='bx bx-cog align-middle' ></i>
            Configuration
        </span>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="align-self-start">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item border-bottom" role="presentation">
                                <a class="nav_link active" id="general-tab" data-bs-toggle="pill" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">
                                    <i class='bx bx-cog nav_icon'></i> General
                                </a>
                            </li>
                            <li class="nav-item border-bottom" role="presentation">
                                <a class="nav_link" id="apparence-tab" data-bs-toggle="pill" data-bs-target="#apparence" type="button" role="tab" aria-controls="apparence" aria-selected="false">
                                    <i class='bx bx-palette nav_icon'></i> Apparence
                                </a>
                            </li>
                            <li class="nav-item border-bottom" role="presentation">
                                <a class="nav_link" id="rewards-tab" data-bs-toggle="pill" data-bs-target="#rewards" type="button" role="tab" aria-controls="rewards" aria-selected="false">
                                    <i class='bx bx-gift nav_icon'></i> Shop Rewards
                                </a>
                            </li>
                            <li class="nav-item border-bottom" role="presentation">
                                <a class="nav_link" id="members-tab" data-bs-toggle="pill" data-bs-target="#members" type="button" role="tab" aria-controls="members" aria-selected="false">
                                    <i class='bx bxs-user-detail nav_icon'></i> Member Roles
                                </a>
                            </li>
                            <li class="nav-item border-bottom" role="presentation">
                                <a class="nav_link" id="logs-tab" data-bs-toggle="pill" data-bs-target="#logs" type="button" role="tab" aria-controls="logs" aria-selected="false">
                                    <i class='bx bx-notepad nav_icon'></i> Action Logs
                                </a>
                            </li>
                            @if ($shop->active)
                                <li class="nav-item  mt-3">
                                    <button class="btn btn-outline-danger w-100">
                                        <i class='bx bx-trash align-baseline me-1'></i>
                                        Disable Shop
                                    </button>
                                </li>
                            @else
                                <li class="nav-item  mt-3">
                                    <button class="btn btn-outline-success w-100">
                                        <i class='bx bxs-show align-baseline me-1'></i>
                                        Enable Shop
                                    </button>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="tab-content p-3" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            {{ view('dashboard.shop.panel.configurations.general', compact('shop', 'currencies')) }}
                        </div>
                        <div class="tab-pane fade" id="apparence" role="tabpanel" aria-labelledby="apparence-tab">
                            {{ view('dashboard.shop.panel.configurations.apparence', compact('shop')) }}
                        </div>
                        <div class="tab-pane fade" id="rewards" role="tabpanel" aria-labelledby="rewards-tab">
                            {{ view('dashboard.shop.panel.configurations.rewards', compact('shop', 'types')) }}
                        </div>
                        <div class="tab-pane fade" id="members" role="tabpanel" aria-labelledby="members-tab">
                            {{ view('dashboard.shop.panel.configurations.members', compact('shop', 'roles')) }}
                        </div>
                        <div class="tab-pane fade" id="logs" role="tabpanel" aria-labelledby="logs-tab">
                            {{ view('dashboard.shop.panel.configurations.logs', compact('shop')) }}
                        </div>
                    </div>
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

        $('#members-datatable').dataTable({
            "order": [[0, 'asc']]
        });

        function deleteMemberRoleHandler() {
            const role = $(this).data('role');

            deleteMemberRole(role);
        }

        $('body')
            .on('click', '.delete-member-role', deleteMemberRoleHandler)
            .on('click', '#refreshTableBtn', reloadLogsTable)
            .on('click', '#add-member-role-button', createRoleMember)
            .on('click', '.edit-memeber-role', editRoleMember)
            .on('click', '#add-member-button', addRoleMemeber)
            .on('click', '#save-member-role-button', saveRoleMember);
    });

    function deleteMemberRole(member_id) {
        const url = '{{ route('dashboard.shop_roles.destroy', ':member_id') }}';

        if(confirm('Are you sure?')) {
            $.ajax({
                url: url.replace(':member_id', member_id),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(responseJSON) {
                    reloadMemberRoleTable();

                    Swal.fire({
                        toast: true,
                        title: responseJSON.message,
                        icon: 'success',
                        showConfirmButton: false,
                        position: 'top-end',
                        timer: 3000
                    });
                },
                error: function(responseJSON) {
                    Swal.fire({
                        toast: true,
                        title: responseJSON.message,
                        icon: 'error',
                        showConfirmButton: false,
                        position: 'top-end',
                        timer: 3000
                    });
                }
            });
        }
    }

    function reloadMemberRoleTable() {
        const url = '{{ route('dashboard.shop_roles.index', ':shop_id') }}';

        $.ajax({
            url: url.replace(':shop_id', '{{ $shop->subdomain }}'),
            type: 'GET',
            success: function (responseJSON) {
                $('#members-datatable tbody').html(responseJSON);
            },
            error: function (responseJSON) {
                Swal.fire({
                    toast: true,
                    title: responseJSON.message,
                    icon: 'error',
                    showConfirmButton: false,
                    position: 'top-end',
                    timer: 3000
                });
            }
        });
    }

    function createRoleMember() {
        const url = '{{ route('dashboard.shop_roles.store', ':shop_id') }}';

        $.ajax({
            url: url.replace(':shop_id', '{{ $shop->subdomain }}'),
            type: 'POST',
            data: $('#frm-role').serialize(),
            success: function (responseJSON) {
                Swal.fire({
                    toast: true,
                    title: responseJSON.message,
                    icon: 'success',
                    showConfirmButton: false,
                    position: 'top-end',
                    timer: 3000
                });

                $('#roleModal').modal('hide');
                reloadMemberRoleTable();
            },
            error: function (responseJSON) {
                Swal.fire({
                    toast: true,
                    title: responseJSON.message,
                    icon: 'error',
                    showConfirmButton: false,
                    position: 'top-end',
                    timer: 3000
                });
            }
        });
    }

    function saveRoleMember() {
        var url = '{{ route('dashboard.shop_roles.update', [':shop_id', ':role_id']) }}';
        url = url.replace(':shop_id', '{{ $shop->subdomain }}');
        url = url.replace(':role_id', $(this).data('id'));

        $.ajax({
            url: url,
            type: 'PUT',
            data: $('#frm-role').serialize(),
            success: function (responseJSON) {
                Swal.fire({
                    toast: true,
                    title: responseJSON.message,
                    icon: 'success',
                    showConfirmButton: false,
                    position: 'top-end',
                    timer: 3000
                });

                $('#roleModal').modal('hide');
                reloadMemberRoleTable();
            },
            error: function (responseJSON) {
                Swal.fire({
                    toast: true,
                    title: responseJSON.message,
                    icon: 'error',
                    showConfirmButton: false,
                    position: 'top-end',
                    timer: 3000
                });
            }
        });
    }

    function editRoleMember() {
        var url = '{{ route('dashboard.shop_roles.edit', [':shop_id', ':shop_role_id']) }}';
        url = url.replace(':shop_id', '{{ $shop->subdomain }}');
        url = url.replace(':shop_role_id', $(this).data('id'));

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                $('#modal-content').html(response);
                $('#roleModal').modal('show');
            }
        });
    }

    function addRoleMemeber() {
        var url = '{{ route('dashboard.shop_roles.create', [':shop_id', ':shop_role_id']) }}';
        url = url.replace(':shop_id', '{{ $shop->subdomain }}');

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                $('#modal-content').html(response);
                $('#roleModal').modal('show');
            }
        });
    }

    function reloadLogsTable() {
        const url = '{{ route('dashboard.shop_logs.index', ':shop_id') }}';

        $.ajax({
            url: url.replace(':shop_id', '{{ $shop->subdomain }}'),
            type: 'GET',
            success: function (responseJSON) {
                $('#logs-datatable tbody').html(responseJSON);
            },
            error: function (responseJSON) {
                Swal.fire({
                    toast: true,
                    title: responseJSON.message,
                    icon: 'error',
                    showConfirmButton: false,
                    position: 'top-end',
                    timer: 3000
                });
            }
        });
    }

</script>
@endsection
