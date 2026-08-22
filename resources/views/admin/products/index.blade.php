@extends('layouts.admin')

@section('content')
<div class="page-header" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 style="margin:0;">Products &amp; Solutions</h1>
        <p style="margin:4px 0 0;color:var(--a-text-muted);font-size:0.88rem;">Manage product offerings, SaaS tools, and external solution links.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-gold">+ Add Product</a>
</div>

<div class="a-card">
    <table class="a-table">
        <thead>
            <tr>
                <th style="width:70px;">Order</th>
                <th>Product Name</th>
                <th>Tagline</th>
                <th>External Link</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr>
                <td><strong>#{{ $product->order }}</strong></td>
                <td>
                    <strong>{{ $product->name }}</strong>
                    <div style="font-size:0.78rem;color:var(--a-text-muted);">/products/{{ $product->slug }}</div>
                </td>
                <td>{{ \Illuminate\Support\Str::limit($product->tagline, 50) ?: '—' }}</td>
                <td>
                    @if($product->external_url)
                        <a href="{{ $product->external_url }}" target="_blank" style="color:var(--a-primary);font-size:0.82rem;">Link ↗</a>
                    @else
                        <span style="color:var(--a-text-muted);">&mdash;</span>
                    @endif
                </td>
                <td>
                    @if($product->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-muted">Hidden</span>
                    @endif
                </td>
                <td style="text-align:right;">
                    <div style="display:inline-flex;gap:6px;">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline btn-sm">Edit</a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:var(--a-text-muted);">No products registered yet. Click "+ Add Product" to get started.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
