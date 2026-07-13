@extends('layouts.admin')

@section('content')
<div class="admin-page-header">
    <div>
        <p class="text-sm font-black uppercase text-teal-700">Content Modules</p>
        <h1>Services</h1>
    </div>
    <a class="rounded bg-teal-700 px-4 py-2 font-bold text-white" href="{{ route('admin.services.create') }}">Add Service</a>
</div>

<div class="overflow-hidden rounded-md bg-white shadow-sm">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-100">
            <tr>
                <th class="p-4">Title</th>
                <th class="p-4">Status</th>
                <th class="p-4">Featured</th>
                <th class="p-4">Order</th>
                <th class="p-4"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr class="border-t border-slate-200">
                <td class="p-4 font-black">{{ $service->title }}<div class="text-xs font-normal text-slate-500">/{{ $service->slug }}</div></td>
                <td class="p-4"><span class="rounded-full bg-teal-50 px-3 py-1 text-xs font-black uppercase text-teal-800">{{ $service->status }}</span></td>
                <td class="p-4">{{ $service->is_featured ? 'Yes' : 'No' }}</td>
                <td class="p-4">{{ $service->sort_order }}</td>
                <td class="p-4 text-right">
                    <a class="font-bold text-teal-700" href="{{ route('admin.services.edit', $service) }}">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
