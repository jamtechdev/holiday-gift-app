@if ($users->count() > 0)
    <div class="card table-scroll-container" style="padding: 0;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #e5e7eb;">
                    <th class="table-head-cell">ID</th>
                    <th class="table-head-cell">Name</th>
                    <th class="table-head-cell">Email</th>
                    <th class="table-head-cell">Role</th>
                    <th class="table-head-cell">Street Address</th>
                    <th class="table-head-cell">Location</th>
                    <th class="table-head-cell">Joined</th>
                    <th class="table-head-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr style="border-bottom: 1px solid #e5e7eb; background-color: #ffffff;">
                        <td class="table-cell">{{ $index + 1 }}</td>
                        <td class="table-cell">{{ $user->name }}</td>
                        <td class="table-cell muted-text">{{ $user->email }}</td>
                        <td class="table-cell">
                            <span class="category-badge">{{ ucfirst($user->role) }}</span>
                        </td>
                        <td class="table-cell muted-text">
                            {{ $user->street_address ?? '—' }}
                            @if ($user->apt_suite_unit)
                                <br><small style="color: #9ca3af;">{{ $user->apt_suite_unit }}</small>
                            @endif
                        </td>
                        <td class="table-cell muted-text">
                            @if ($user->city || $user->state || $user->zip)
                                {{ $user->city }}{{ $user->city && ($user->state || $user->zip) ? ',' : '' }}
                                {{ $user->state }} {{ $user->zip }}
                            @else
                                —
                            @endif
                            @if ($user->country)
                                <br><small style="color: #9ca3af;">{{ $user->country }}</small>
                            @endif
                        </td>
                        <td class="table-cell muted-text">
                            {{ $user->created_at?->format('M d, Y') }}
                        </td>
                        <td class="table-cell">
                            <div class="table-actions">
                                <a href="{{ route('admin.users.edit', $user) }}" class="admin-btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn-sm admin-btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="paginationContainer" style="padding: 1.25rem 1.5rem; border-top: 1px solid rgba(229, 231, 235, 0.8);">
            @include('partials.admin.pagination', [
                'paginator' => $users,
                'itemLabel' => 'users',
            ])
        </div>
    </div>
@else
    <div class="card" style="text-align: center; padding: 4rem 2rem;">
        <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;">👥</div>
        <h4 style="color: #374151; margin-bottom: 0.5rem;">No users found</h4>
        <p style="color: #6b7280; margin-bottom: 2rem;">Start by creating your first user</p>
        <a href="{{ route('admin.users.create') }}" class="admin-btn">Create First User</a>
    </div>
@endif
