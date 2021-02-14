<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($products as $product)
    <url>
        <loc>{{ urldecode(route('guest.product', $product->slug)) }}</loc>
        <lastmod>{{ $product->updated_at }}</lastmod>
        <changefreq>hourly</changefreq>
        <image:image>
            <image:loc>{{ picture( $product , true , "picture",'full' ) }}</image:loc>
            <image:caption>{{ $product->title }}</image:caption>
            <image:title>{{ $product->summary }}</image:title>
        </image:image>
    </url>
    @endforeach
</urlset>
