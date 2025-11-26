@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('admin-content')
<div class="flex flex-col h-full overflow-hidden">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        <div class="bg-gradient-to-br from-white via-slate-50 to-slate-200 rounded-3xl p-7 shadow-2xl border border-slate-300">
            <div class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($stats['total_users']) }}</div>
            <div class="text-sm text-gray-600 tracking-wider uppercase">Total Users</div>
        </div>
        <div class="bg-gradient-to-br from-white via-slate-50 to-slate-200 rounded-3xl p-7 shadow-2xl border border-slate-300">
            <div class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($stats['total_categories']) }}</div>
            <div class="text-sm text-gray-600 tracking-wider uppercase">Categories</div>
        </div>
        <div class="bg-gradient-to-br from-white via-slate-50 to-slate-200 rounded-3xl p-7 shadow-2xl border border-slate-300">
            <div class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($stats['total_gifts']) }}</div>
            <div class="text-sm text-gray-600 tracking-wider uppercase">Active Gifts</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 flex-1 min-h-0">
        <div class="lg:col-span-2 bg-gradient-to-br from-white via-slate-50 to-slate-200 rounded-3xl p-7 shadow-2xl border border-slate-300 flex flex-col min-h-0">
            <h3 class="text-gray-900 mb-4 text-xl tracking-wider uppercase font-semibold">Recent Gifts</h3>
            <div class="flex-1 overflow-auto">
                @if($stats['recent_gifts']->count() > 0)
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="p-2.5 text-left border-b border-slate-300 bg-slate-50 font-semibold text-gray-700">Gift Name</th>
                                <th class="p-2.5 text-left border-b border-slate-300 bg-slate-50 font-semibold text-gray-700">Category</th>
                                <th class="p-2.5 text-left border-b border-slate-300 bg-slate-50 font-semibold text-gray-700">Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats['recent_gifts'] as $gift)
                                <tr>
                                    <td class="p-2.5 text-left border-b border-slate-300 text-gray-600">{{ $gift->name }}</td>
                                    <td class="p-2.5 text-left border-b border-slate-300 text-gray-600">
                                        <span class="px-2 py-1 rounded text-xs font-medium" style="background-color: {{ $gift->category->accent_color ?? '#e5e7eb' }}20; color: {{ $gift->category->accent_color ?? '#4b5563' }};">
                                            {{ $gift->category->name }}
                                        </span>
                                    </td>
                                    <td class="p-2.5 text-left border-b border-slate-300 text-gray-600">{{ $gift->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center text-gray-500 py-8">No gifts yet</div>
                @endif
            </div>
        </div>

        <div class="bg-gradient-to-br from-white via-slate-50 to-slate-200 rounded-3xl p-7 shadow-2xl border border-slate-300">
            <h3 class="text-gray-900 mb-4 text-xl tracking-wider uppercase font-semibold">Quick Stats</h3>
            <div class="space-y-5">
                <div class="flex justify-between items-center text-gray-600">
                    <span>Today's Gifts</span>
                    <strong class="text-gray-900">{{ number_format($stats['today_gifts']) }}</strong>
                </div>
                <div class="flex justify-between items-center text-gray-600">
                    <span>Total Users</span>
                    <strong class="text-gray-900">{{ number_format($stats['total_users']) }}</strong>
                </div>
                <div class="flex justify-between items-center text-gray-600">
                    <span>Total Categories</span>
                    <strong class="text-gray-900">{{ number_format($stats['total_categories']) }}</strong>
                </div>
            </div>
            
            @if($stats['recent_users']->count() > 0)
                <div class="mt-6 pt-6 border-t border-slate-300">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3 uppercase tracking-wider">Recent Users</h4>
                    <div class="space-y-2">
                        @foreach($stats['recent_users']->take(5) as $user)
                            <div class="text-sm text-gray-600">
                                <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection