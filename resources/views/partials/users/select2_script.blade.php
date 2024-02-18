<script>
    $(document).ready(function() {
        const url = '{{ route('dashboard.users.select2', ':shop_id') }}';

        $('#user-select').select2({
            dropdownParent: $('#userModal'),
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
    });
</script>
