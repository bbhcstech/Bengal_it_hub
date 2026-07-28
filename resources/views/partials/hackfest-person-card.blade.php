@php
    $hackFestPath = 'HackFest/';
    $hackFestImage = fn ($file) => asset($hackFestPath.rawurlencode($file));
    $personImages = [
        'Dr. Mahuya Hom Choudhury' => 'Dr.Mahuya Hom Choudhury.png',
        'Mr. Debashis Sen' => 'Debasish_Sen.png',
        'Dr. Pallabi Sengupta' => 'pallabi sengupta image.jpg',
        'Dr. Swastik Nandi' => 'Dr. Swastik.jpeg',
        'Mr. Monoj K. Nath' => 'Monoj Nath.jpeg',
        'Dr. Tanushyam Chattopadhyay' => 'Tanushyam Chattopadhyay.jpg',
        'Adv. Tapojit Dey' => 'Tapojit Dey.jpeg',
        'Mr. Hemanta Ghosh' => 'HEMANTA GHOSH.jpg.jpeg',
        'Dr. Ranjan Ghosh' => 'Dr Ranjan Ghosh.jpeg',
        'Mr. Souvik Das' => 'Souvik Das.jpeg',
    ];
    $personPhoto = fn ($name) => !empty($personImages[$name]) ? $hackFestImage($personImages[$name]) : null;
    [$role, $name, $bio, $linkedin] = $person;
    $photo = $personPhoto($name);
    $cardClass = ($variant ?? 'feature') === 'grid' ? 'bih-hackfest-person-card' : 'bih-hackfest-feature-person';
@endphp
<article class="{{ $cardClass }}">
    @if($photo)
        <img src="{{ $photo }}" alt="{{ $name }}">
    @else
        <div class="bih-hackfest-person-fallback">{{ collect(explode(' ', $name))->filter()->map(fn ($part) => Str::substr($part, 0, 1))->take(2)->implode('') }}</div>
    @endif
    <div>
        <p class="bih-eyebrow">{{ $roleLabel ?? $role }}</p>
        <h3>{{ $name }}</h3>
        @isset($extraIntro)
            <p>{{ $extraIntro }}</p>
        @endisset
        <p>{{ $bio }}</p>
        @if(!empty($linkedin))
            <a href="{{ $linkedin }}" target="_blank" rel="noopener">LinkedIn</a>
        @endif
    </div>
</article>
