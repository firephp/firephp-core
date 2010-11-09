<?php

RETURN_RAW();

$inspector = FirePHP::to("page"); 
 
$console = $inspector->console();

$console->log('Hello World');


header('Content-Type: text/xml');

$xml = <<<EOT
<?xml version="1.0" encoding="utf-8"?>

<rss version="2.0">
<channel>
    <title>The title of my RSS 2.0 Feed</title>
    <link>http://www.example.com/</link>
    <description>This is my rss 2 feed description</description>
    <lastBuildDate>Mon, 12 Sep 2005 18:37:00 GMT</lastBuildDate>
    <language>en-us</language>

    <item>
        <title>Title of an item</title>
        <link>http://example.com/item/123</link>
        <guid>http://example.com/item/123</guid>
        <pubDate>Mon, 12 Sep 2005 18:37:00 GMT</pubDate>
        <description>[CDATA[ This is the description. ]]</description>
    </item>

</channel>
</rss>

EOT;

echo $xml;
