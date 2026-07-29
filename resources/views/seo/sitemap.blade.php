<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="{{ $publicUrl('sitemap.xsl') }}"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($urls as $url)
    <url>
        <loc>{{ $publicUrl($url['loc']) }}</loc>
        <lastmod>{{ ($url['lastmod'] ?? now())->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>{{ $url['loc'] === '/' ? '1.0' : '0.8' }}</priority>
    </url>
@endforeach
</urlset>
