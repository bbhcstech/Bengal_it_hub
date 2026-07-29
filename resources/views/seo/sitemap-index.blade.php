<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="{{ $publicUrl('sitemap-index.xsl') }}"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($sitemaps as $sitemap)
    <sitemap>
        <loc>{{ $publicUrl($sitemap['loc']) }}</loc>
        <lastmod>{{ ($sitemap['lastmod'] ?? now())->toAtomString() }}</lastmod>
    </sitemap>
@endforeach
</sitemapindex>
