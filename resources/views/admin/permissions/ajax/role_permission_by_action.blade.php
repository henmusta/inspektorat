<table class="table">
    <thead>
        <th>{{ __('Role Name') }}</th>
        <th>{{ __('Allow/Deny') }}</th>
    </thead>
    <tbody>
        @forelse($roles as $role)
            @php
                $checked = Acl::checked_role_permission($role->id, $permission_id);
            @endphp
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    <label class="permission-switch">
                        <input type="checkbox" class="RoleCheckbox permissionCheckbox_{{ $role->id }}" id="RoleCheckbox_{{ $role->id }}_{{ $permission_id }}" data-role-id="{{ $role->id }}" data-permission-id="{{ $permission_id }}" rdx-link="{{ route('admin.permissions.manage-role-permission', ['role_id'=> $role->id, 'permission_id' => $permission_id] )}}" {{ $checked }}>
                        <span class="permission-switch-slider"></span>
                    </label>
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>