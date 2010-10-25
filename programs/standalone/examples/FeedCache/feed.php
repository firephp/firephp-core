<?php

class Feed {

    /*i*/ private $console;
    private $url = false;
    private $ttl = 10;  // in seconds
    private $didLoad = false;

    public function __construct($url) {
        $this->url = $url;
        /*i*/ $this->console = FirePHP::to('request')->console('Feed')->on('Feed Debug');
    }
    
    public function getUrl() {
        return $this->url;
    }

    public function didLoad() {
        return $this->didLoad;
    }

    public function getItems() {
        $this->didLoad = false;

        $file = $this->getCachePath();

        /*i*/ $this->console->label('Cache File')->log($file);
        /*i*/ $this->console->label('Cache File Exists')->log(file_exists($file));

        if(file_exists($file)) {
            $fileTime = filemtime($file);
            $fileTtl = time()-$fileTime;
            /*i*/ $this->console->label('Cache Time Remaining')->log($this->ttl-$fileTtl);
        } else {
            $fileTime = false;
            $fileTtl = 0;
        }

        if($fileTtl >= $this->ttl
           /*i*/ || FirePHP::to('request')->console('Feed')->on('Force Reload Cache')->is(true)
          ) {
            /*i*/ $this->console->info('Deleting Cache File');
            if(file_exists($file)) {
                unlink($file);
            }
        }

        if(!file_exists($file)) {
            /*i*/ $group = $this->console->group()->open();
            /*i*/ $this->console->log('Load feed and store in cache file');
            $this->load();
            /*i*/ $group->close();
        /*i*/ } else {
        /*i*/     $this->console->info('Skip load as feed is cached');
        }

        $json = json_decode(file_get_contents($file), true);

        /*i*/ $this->console->label('Feed data')->log($json);

        return $json;
    }
    
    private function load() {        
        $this->didLoad = true;
        
        $file = $this->getCachePath();

        /*i*/ $this->console->label('URL')->log($this->url);

        $startTime = microtime(true);
    	$content = utf8_encode(file_get_contents($this->url));

        /*i*/ $this->console->label('Load Time')->log(round(microtime(true)-$startTime,5));
        /*i*/ $this->console->label('Raw Feed Data')->log($content);

    	$xml = simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA);
    	if(!$xml) {
            /*i*/ $this->console->error('Error parsing XML data');
    	    throw new Exception('Error parsing XML data');
    	}
        /*i*/ $this->console->label('Parsed Feed XML')->log($xml);

    	$data = array();
    	foreach( $xml->channel->item as $item ) {
    	    $data[] = array(
    	        'title' => (string)$item->title,
    	        'link' => (string)$item->link
    	    );
        }

        /*i*/ $this->console->label('Final JSON Data')->log($data);

    	file_put_contents($file, json_encode($data));

        /*i*/ if(file_exists($file)) {
        /*i*/     $this->console->info('Saved cache file');
        /*i*/ } else {
        /*i*/     $this->console->error('Error writing to cache file');
        /*i*/ }
    }

    private function getCachePath() {
        return dirname(__FILE__) . '/cache.txt';
    }    
}
