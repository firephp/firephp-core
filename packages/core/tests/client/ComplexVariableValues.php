<?php

$firephp = FirePHP::getInstance(true);


$array = array();
$array['html1'] = '<p>Test Paragraph</p>';
$array['html2'] = '<p>Test Paragraph</p>'."\n".'<p>Another paragraph on a new line</p>';
$array['html3'] = '<p>jhgjhgf ghj hg hgfhgfh hgjvhgjfhgj h hgfhjgfhjg ghhgjfghf hgfhgfhgfhg hgfhgfhgf hgfhgjftfitf yt76i f tf76t67r76 7 76f7if 6f67f i76ff</p>';

$firephp->fb($array);

$testArray = array('key'=>'value');

$firephp->fb($testArray  ,FirePHP::LOG);
$firephp->fb($testArray ,FirePHP::INFO);
$firephp->fb($testArray ,FirePHP::WARN);
$firephp->fb($testArray,FirePHP::ERROR);

$firephp->fb('Test line 1'."\n".'Test Line 2' ,FirePHP::INFO);

$firephp->fb('Log message', 'Label' ,FirePHP::LOG);
$firephp->fb('Info message', 'Label' ,FirePHP::INFO);
$firephp->fb('Warn message', 'Label' ,FirePHP::WARN);
$firephp->fb('Error message', 'Label',FirePHP::ERROR);



$firephp->fb(array('one','two','three'));
$firephp->fb(array(0=>'one', 1=>'two', 2=>'three'));

