{!! $xml_version !!}
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{--
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        <url>
            <loc>{{url('/')}}</loc>
            <lastmod>{{date('Y-m-d')}}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
        @foreach($stories as $story) 
                <url>
                    <loc>{{url('/story/' . $story->slug)}}</loc>
                    <lastmod>{{date('YYYY-MM-DDThh:mmTZD')}}</lastmod>
                    <changefreq>weekly</changefreq>
                    <priority>0.8</priority>
                </url>
                @foreach($story->chapters as $chapter)
                <url>
                    <loc>{{url('/chapter/' . $chapter->slug)}}</loc>
                    <lastmod>{{date_format(date_create($chapter->updated_at),"YYYY-MM-DDThh:mmTZD")}}</lastmod>
                    <changefreq>monthly</changefreq>
                    <priority>0.7</priority>
                </url>
                @endforeach 
        @endforeach
    </urlset>
    --}}
    @foreach($stories as $story)
        <sitemap>
            <loc>{{url('/')}}/sitemap-{{$story->slug}}.xml</loc>
            <lastmod>{{\Carbon\Carbon::parse($story->updated_at)->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP')}}</lastmod>
        </sitemap>
    @endforeach
</sitemapindex>