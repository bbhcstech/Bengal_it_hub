<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:sm="http://www.sitemaps.org/schemas/sitemap/0.9">
<xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
<xsl:template match="/">
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>XML Sitemap Index — Bengal IT Hub</title>
    <style>
        :root{--ink:#0b1220;--soft:#5a6672;--line:#e2e8e6;--accent:#0f766e;--accent-deep:#0b4f49;--paper:#f4f7f6;}
        *{box-sizing:border-box;}
        body{margin:0;background:var(--paper);color:var(--ink);font-family:-apple-system,"Segoe UI",Roboto,Arial,sans-serif;line-height:1.5;}
        .wrap{max-width:960px;margin:0 auto;padding:40px 24px 64px;}
        .brand{display:flex;align-items:center;gap:12px;margin-bottom:28px;}
        .brand .mark{width:40px;height:40px;border-radius:9px;background:var(--accent);color:#fff;display:grid;place-items:center;font-weight:800;font-size:15px;flex:none;}
        .brand strong{font-size:16px;}
        .brand span{display:block;font-size:12px;color:var(--soft);}
        h1{font-size:24px;margin:0 0 8px;}
        .intro{color:var(--soft);font-size:14px;max-width:620px;margin:0 0 28px;}
        .count{display:inline-block;background:#e3f1ef;color:var(--accent-deep);font-weight:700;font-size:12.5px;padding:4px 10px;border-radius:99px;margin-bottom:20px;}
        .table-wrap{overflow-x:auto;border:1px solid var(--line);border-radius:10px;background:#fff;}
        table{width:100%;border-collapse:collapse;min-width:520px;}
        th{text-align:left;font-size:11.5px;letter-spacing:.04em;text-transform:uppercase;color:var(--soft);font-weight:700;padding:12px 18px;border-bottom:1px solid var(--line);background:#fafcfb;}
        td{padding:13px 18px;font-size:13.5px;border-bottom:1px solid var(--line);vertical-align:middle;}
        tr:last-child td{border-bottom:none;}
        tr:hover td{background:#f7fbfa;}
        a{color:var(--accent-deep);text-decoration:none;font-weight:600;word-break:break-all;}
        a:hover{text-decoration:underline;}
        .lastmod{color:var(--soft);white-space:nowrap;font-variant-numeric:tabular-nums;}
        footer{margin-top:24px;font-size:12px;color:var(--soft);}
    </style>
</head>
<body>
<div class="wrap">
    <div class="brand">
        <span class="mark">B</span>
        <span><strong>Bengal IT Hub</strong><span>XML Sitemap Index</span></span>
    </div>
    <h1>Sitemap Index</h1>
    <p class="intro">This index lists every sub-sitemap that makes up bengalithub.com, generated automatically so it always matches the live site. Search engines read this file directly — the layout below is only for humans opening it in a browser.</p>
    <span class="count"><xsl:value-of select="count(sm:sitemapindex/sm:sitemap)"/> sitemaps</span>
    <div class="table-wrap">
    <table>
        <tr><th>Sitemap</th><th>Last Modified</th></tr>
        <xsl:for-each select="sm:sitemapindex/sm:sitemap">
        <tr>
            <td><a href="{sm:loc}"><xsl:value-of select="sm:loc"/></a></td>
            <td class="lastmod"><xsl:value-of select="sm:lastmod"/></td>
        </tr>
        </xsl:for-each>
    </table>
    </div>
    <footer>Generated dynamically by bengalithub.com — not a static file.</footer>
</div>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
