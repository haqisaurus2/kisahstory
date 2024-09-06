{!! $xml_version !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        <url>
            <loc>{{url('/story/' . $story->slug)}}</loc>
            <lastmod>{{date('Y-m-d')}}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
        @foreach($story->chapters as $chapter)
        <url>
            <loc>{{url('/chapter/' . $chapter->slug)}}</loc>
            <lastmod>{{date_format(date_create($chapter->updated_at),"Y-m-d")}}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
        @endforeach
    </urlset>
 
</urlset>
