@foreach ($shopRoles as $role)
<tr>
    <td>{{ $role->user->fullName }}</td>
    <td>{{ $role->user->email }}</td>
    <td>{{ ucfirst($role->role) }}</td>
    <td>
        <button class="btn btn-secondary edit-member-role" data-id="{{ $role->id }}"><i class='bx bx-edit align-middle'></i></button>
        @if ($role->user_id !== auth()->user()->id && $role->role !== 'Owner')
            <button class="btn btn-danger delete-member-role" type="button" data-role="{{ $role->id }}"><i class='bx bx-trash align-middle'></i></button>
        @endif
    </td>
</tr>
@endforeach
