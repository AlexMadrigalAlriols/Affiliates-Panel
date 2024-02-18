<script>
    $(document).ready(function() {
        $('#members-datatable').dataTable({
            "order": [
                [0, 'asc']
            ]
        });

        function deleteMemberRoleHandler() {
            const role = $(this).data('role');

            deleteMemberRole(role);
        }

        $('body')
            .on('click', '.delete-member-role', deleteMemberRoleHandler)
            .on('click', '#add-member-role-button', createRoleMember)
            .on('click', '.edit-member-role', editRoleMember)
            .on('click', '#add-member-button', addRoleMemeber)
            .on('click', '#save-member-role-button', saveRoleMember);
    });

    function deleteMemberRole(member_id) {
        const url = '{{ route('dashboard.shop_roles.destroy', ':member_id') }}';

        if (confirm('Are you sure?')) {
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
        const url = '{{ route('dashboard.shop.panel.configuration.roles.index', ':shop_id') }}';

        $.ajax({
            url: url.replace(':shop_id', '{{ $shop->subdomain }}'),
            type: 'GET',
            success: function(responseJSON) {
                $('#members-datatable tbody').html(responseJSON);
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

    function createRoleMember() {
        const url = '{{ route('dashboard.shop_roles.store', ':shop_id') }}';

        $.ajax({
            url: url.replace(':shop_id', '{{ $shop->subdomain }}'),
            type: 'POST',
            data: $('#frm-role').serialize(),
            success: function(responseJSON) {
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

    function saveRoleMember() {
        var url = '{{ route('dashboard.shop_roles.update', [':shop_id', ':role_id']) }}';
        url = url.replace(':shop_id', '{{ $shop->subdomain }}');
        url = url.replace(':role_id', $(this).data('id'));

        $.ajax({
            url: url,
            type: 'PUT',
            data: $('#frm-role').serialize(),
            success: function(responseJSON) {
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

    function editRoleMember() {
        var url = '{{ route('dashboard.shop_roles.edit', [':shop_id', ':shop_role_id']) }}';
        url = url.replace(':shop_id', '{{ $shop->subdomain }}');
        url = url.replace(':shop_role_id', $(this).data('id'));

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#modal-content').html(response);
                $('#roleModal').modal('show');

                loadSelect2Members();
            }
        });
    }

    function addRoleMemeber() {
        var url = '{{ route('dashboard.shop_roles.create', [':shop_id', ':shop_role_id']) }}';
        url = url.replace(':shop_id', '{{ $shop->subdomain }}');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#modal-content').html(response);
                $('#roleModal').modal('show');

                loadSelect2Members();
            }
        });
    }

    function loadSelect2Members() {
        const url = '{{ route('dashboard.users.select2', ':shop_id') }}';

        $('#user-select').select2({
            dropdownParent: $('#roleModal'),
            ajax: {
                url: url.replace(':shop_id', '{{ $shop->subdomain }}'),
                dataType: 'json',
                data: params => {
                    return {
                        search: params.term,
                        page: params.page || 1
                    }
                },
                processResults: function(datam, params) {
                    params.page = params.page || 1;

                    return {
                        results: parseSelect2Results(datam.results),
                        pagination: {
                            more: (params.page * 15) < datam.count
                        }
                    };
                }
            }
        });
    }
</script>
