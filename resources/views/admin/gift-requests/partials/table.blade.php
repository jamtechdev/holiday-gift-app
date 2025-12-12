@if($requests->count() > 0)
    <div class="card table-scroll-container" style="padding: 0;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #e5e7eb;">
                    <th class="table-head-cell">Name</th>
                    <th class="table-head-cell">Email</th>
                    <th class="table-head-cell">Category</th>
                    <th class="table-head-cell">Street Address</th>
                    <th class="table-head-cell">Location</th>
                    <th class="table-head-cell">Company</th>
                    <th class="table-head-cell">Submitted</th>
                    <th class="table-head-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr style="border-bottom: 1px solid #e5e7eb; background-color: #ffffff;">
                        <td class="table-cell">{{ $request->name }} {{ $request->lastname ?? '' }}</td>
                        <td class="table-cell muted-text">{{ $request->email }}</td>
                        <td class="table-cell">
                            <span class="category-badge">{{ $request->category->name ?? 'Uncategorized' }}</span>
                        </td>
                        <td class="table-cell muted-text">
                            {{ $request->street_address ?? '—' }}
                            @if($request->street_address2)
                                <br><small style="color: #9ca3af;">{{ $request->street_address2 }}</small>
                            @endif
                        </td>
                        <td class="table-cell muted-text">
                            {{ $request->city }}, {{ $request->state }} {{ $request->zip }}
                            @if($request->country)
                                <br><small style="color: #9ca3af;">{{ $request->country }}</small>
                            @endif
                        </td>
                        <td class="table-cell muted-text">
                            {{ $request->company ?? '—' }}
                        </td>
                        <td class="table-cell muted-text">
                            {{ $request->created_at?->format('M d, Y') }}
                        </td>
                        <td class="table-cell">
                            <div class="table-actions">
                                <a href="{{ route('admin.gift-requests.show', $request) }}" class="admin-btn-sm">View</a>
                                <form method="POST" action="{{ route('admin.gift-requests.destroy', $request) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn-sm admin-btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="paginationContainer" style="padding: 1.25rem 1.5rem; border-top: 1px solid rgba(229, 231, 235, 0.8);">
            @include('partials.admin.pagination', [
                'paginator' => $requests,
                'itemLabel' => 'gift requests',
                'range' => 1
            ])
        </div>
    </div>
@else
    <div class="card" style="text-align: center; padding: 4rem 2rem;">
        <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;">📋</div>
        <h4 style="color: #374151; margin-bottom: 0.5rem;">No gift requests found</h4>
        <p style="color: #6b7280;">Gift requests will appear here when users submit them</p>
    </div>
@endif

