{!! $xml_version !!}
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{url('/story/' . $story->slug)}}</loc>
        <lastmod>
            {{\Carbon\Carbon::parse(time: $story->updated_at)->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP')}}
        </lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @foreach($story->chapters as $chapter)
        <url>
            <loc>{{url('/chapter/' . $chapter->slug)}}</loc>
            <lastmod>{{date_format(date_create($chapter->updated_at), "YYYY-MM-DDThh:mm:ss.sTZD")}}</lastmod>
            <lastmod>
                {{\Carbon\Carbon::parse(time: $chapter->updated_at)->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP')}}
            </lastmod>

            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>