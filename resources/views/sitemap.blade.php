<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        <url>
            <loc>{{url('/')}}</loc>
            <lastmod>{{date('Y-m-d')}}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
    </urlset>
    @foreach($stories as $story)
        <sitemap>
            <loc>{{url('/')}}/sitemap-{{$story->slug}}.xml</loc>
            <lastmod>{{date_format(date_create($story->updated_at),"Y-m-d")}}</lastmod>
        </sitemap>
    @endforeach
</sitemapindex>