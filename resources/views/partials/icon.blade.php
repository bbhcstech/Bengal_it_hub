@php($size = $size ?? 'h-5 w-5')
@switch($name)
    @case('target')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="4.4" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="1.2" fill="currentColor"/></svg>
        @break
    @case('graduation')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3 2 8l10 5 10-5-10-5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M6 10.6V15c0 1.4 2.7 2.5 6 2.5s6-1.1 6-2.5v-4.4" stroke="currentColor" stroke-width="1.6"/><path d="M21 9v5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        @break
    @case('university')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 21V10l8-5 8 5v11" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M4 21h16M9 21v-6h6v6" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
        @break
    @case('partners')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="7" cy="12" r="3.3" stroke="currentColor" stroke-width="1.6"/><circle cx="17" cy="12" r="3.3" stroke="currentColor" stroke-width="1.6"/><path d="M10.3 12h3.4" stroke="currentColor" stroke-width="1.6"/></svg>
        @break
    @case('admin')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="8" r="3.2" stroke="currentColor" stroke-width="1.7"/><path d="M5.8 19.5c.8-3.3 3-5 6.2-5s5.4 1.7 6.2 5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M17.8 8.8h2.9m-1.4-1.4v2.9" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        @break
    @case('rocket')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 2c3 2 5 6 5 10 0 2-1 4-2 5l-3 2-3-2c-1-1-2-3-2-5 0-4 2-8 5-10Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="12" cy="10" r="1.5" stroke="currentColor" stroke-width="1.4"/><path d="M9 17 7 21m8-4 2 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        @break
    @case('briefcase')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3.5" y="8" width="17" height="11" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M9 8V6a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="1.6"/></svg>
        @break
    @case('flask')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M10 3h4M10 3v5.4L5.6 17a2 2 0 0 0 1.8 3h9.2a2 2 0 0 0 1.8-3L14 8.4V3" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M8.6 14h6.8" stroke="currentColor" stroke-width="1.6"/></svg>
        @break
    @case('globe')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8.4" stroke="currentColor" stroke-width="1.6"/><path d="M3.6 12h16.8M12 3.6c2.3 2.3 3.5 5.2 3.5 8.4S14.3 18.1 12 20.4C9.7 18.1 8.5 15.2 8.5 12S9.7 5.9 12 3.6Z" stroke="currentColor" stroke-width="1.6"/></svg>
        @break
    @case('check')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12.5 9.5 17 19 7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break
    @case('chip')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="7" y="7" width="10" height="10" rx="1.5" stroke="currentColor" stroke-width="1.6"/><path d="M9.6 9.6h4.8v4.8H9.6zM12 3v3.2M12 17.8V21M3 12h3.2M17.8 12H21M5.6 5.6l2 2M16.4 16.4l2 2M18.4 5.6l-2 2M7.6 16.4l-2 2" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
        @break
    @case('chat')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 5h16v10H8l-4 4V5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M8 9h8M8 12h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        @break
    @case('leadership')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 3v18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M6 4h11l-2.5 3.5L17 11H6" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
        @break
    @case('adapt')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12a8 8 0 0 1 13.6-5.7M20 12a8 8 0 0 1-13.6 5.7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M17 3v4h-4M7 21v-4h4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break
    @case('trophy')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 4h10v4a5 5 0 0 1-5 5 5 5 0 0 1-5-5V4Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M7 5H4v1.5A3.5 3.5 0 0 0 7.5 10M17 5h3v1.5A3.5 3.5 0 0 1 16.5 10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M12 13v3.5M9 20h6M8.5 20c0-1.8 1.2-3 3.5-3s3.5 1.2 3.5 3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @break
    @case('medal')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M8.5 3h7l-2.4 6.4M8.5 3l2.4 6.4M8.5 3 6 9.4M15.5 3 18 9.4" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="12" cy="15" r="5.4" stroke="currentColor" stroke-width="1.6"/><path d="M12 12.2 12.9 14l1.9.3-1.4 1.4.3 1.9-1.7-.9-1.7.9.3-1.9-1.4-1.4 1.9-.3.9-1.8Z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/></svg>
        @break
    @case('star')
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12 3.5 2.6 5.4 5.9.8-4.3 4.2 1 5.9-5.2-2.8-5.2 2.8 1-5.9-4.3-4.2 5.9-.8L12 3.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
        @break
    @default
        <svg class="{{ $size }}" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.6"/></svg>
@endswitch
