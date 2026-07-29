@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Tech Innovation</p>
        <h1>RSS Sources</h1>
    </div>
    <div class="flex gap-2">
        <form method="POST" action="{{ route('admin.rss-sources.sync-all') }}">
            @csrf
            <button class="rounded bg-slate-950 px-4 py-2 font-bold text-white" type="submit">Sync All Now</button>
        </form>
        <a class="rounded bg-teal-700 px-4 py-2 font-bold text-white" href="{{ route('admin.rss-sources.create') }}">Add RSS Source</a>
    </div>
</div>

<div class="overflow-x-auto rounded-md bg-white shadow-sm">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-100">
            <tr>
                <th class="p-4">Source</th>
                <th class="p-4">Category</th>
                <th class="p-4">Status</th>
                <th class="p-4">Last Sync</th>
                <th class="p-4">Result</th>
                <th class="p-4"></th>
            </tr>
        </thead>
        <tbody>
        @forelse($sources as $source)
            <tr class="border-t border-slate-200">
                <td class="p-4 font-black">
                    {{ $source->name }}
                    <div class="text-xs font-normal text-slate-500">{{ $source->feed_url }}</div>
                </td>
                <td class="p-4">{{ $source->category?->name ?? '—' }}</td>
                <td class="p-4">
                    <span class="rounded-full px-3 py-1 text-xs font-black uppercase {{ $source->is_active ? 'bg-teal-50 text-teal-800' : 'bg-slate-100 text-slate-500' }}">
                        {{ $source->is_active ? 'Enabled' : 'Disabled' }}
                    </span>
                </td>
                <td class="p-4">{{ $source->last_synced_at?->diffForHumans() ?? 'Never synced' }}</td>
                <td class="p-4">
                    @if($source->last_sync_status)
                        <span class="rounded-full px-3 py-1 text-xs font-black uppercase {{ $source->last_sync_status === 'success' ? 'bg-teal-50 text-teal-800' : 'bg-red-50 text-red-700' }}">
                            {{ $source->last_sync_status }}
                        </span>
                        <div class="mt-1 max-w-xs text-xs text-slate-500">{{ Str::limit($source->last_sync_message, 90) }}</div>
                    @else
                        <span class="text-xs text-slate-500">Not synced yet</span>
                    @endif
                </td>
                <td class="p-4 text-right">
                    <div class="flex items-center justify-end gap-3">
                        <form method="POST" action="{{ route('admin.rss-sources.sync', $source) }}">
                            @csrf
                            <button class="font-bold text-teal-700" type="submit">Sync Now</button>
                        </form>
                        <a class="font-bold text-slate-700" href="{{ route('admin.rss-sources.edit', $source) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.rss-sources.delete', $source) }}" onsubmit="return confirm('Delete this RSS source? Imported articles will remain.');">
                            @csrf @method('DELETE')
                            <button class="font-bold text-red-600" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td class="p-4 text-slate-500" colspan="6">No RSS sources yet. Add your first source to start building the Tech Innovation feed.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
