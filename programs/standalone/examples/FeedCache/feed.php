<?php

class Feed {

    private $console;
    private $url = false;
    private $ttl = 10;  // in seconds

    public function __construct($url) {
        $this->url = $url;
        $this->console = FirePHP::to('request')->console('Feed')->on('Feed Debug');
    }
    
    public function getItems() {
        $file = $this->getCachePath();

        $this->console->label('Cache File')->log($file);
        $this->console->label('Cache File Exists')->log(file_exists($file));

        if(file_exists($file)) {
            $fileTime = @filemtime($file);
            $fileTtl = time()-$fileTime;

            $this->console->label('Cache Time Remaining')->log($this->ttl-$fileTtl);

        } else {
            $fileTime = false;
            $fileTtl = 0;
        }

        if($fileTtl >= $this->ttl || $this->console->on('Force Reload Cache')->is(true)) {
            $this->console->info('Deleting Cache File');
            @unlink($file);
        }

        if(!file_exists($file)) {
            $group = $this->console->group()->open();
            $this->console->log('Load feed and store in cache file');
            $this->load();
            $group->close();
        } else {
            $this->console->info('Skip load as feed is cached');
        }

        $json = json_decode(file_get_contents($file), true);

        $this->console->label('Feed data')->log($json);

        return $json;
    }
    
    private function load() {
        
        echo '<p><b>Loading feed from: '.$this->url.'</b></p>'."\n";
        
        $file = $this->getCachePath();

        $this->console->label('URL')->log($this->url);

        $startTime = microtime(true);
    	$content = utf8_encode(file_get_contents($this->url));

        $this->console->label('Load Time')->log(round(microtime(true)-$startTime,5));
        $this->console->label('Raw Feed Data')->log($content);

    	$xml = simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA);
    	if(!$xml) {
            $this->console->error('Error parsing XML data');
    	    throw new Exception('Error parsing XML data');
    	}
        $this->console->label('Parsed Feed XML')->log($xml);

    	$data = array();
    	foreach( $xml->channel->item as $item ) {
    	    $data[] = array(
    	        'title' => (string)$item->title,
    	        'link' => (string)$item->link
    	    );
        }

        $this->console->label('Final JSON Data')->log($data);

    	file_put_contents($file, json_encode($data));

        if(file_exists($file)) {
            $this->console->info('Saved cache file');
        } else {
            $this->console->error('Error writing to cache file');
        }
    }

    private function getCachePath() {
        return __DIR__ . '/cache.txt';
    }    
}
