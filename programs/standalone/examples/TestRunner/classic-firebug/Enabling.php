<?php

$firephp = FirePHP::getInstance(true);

if($firephp->getEnabled()) {
  $firephp->info('Enabled');
}

$firephp->fb('This should show');

$firephp->setEnabled(false);

if(!$firephp->getEnabled()) {
  $firephp->info('Disabled');
}

$firephp->fb('This should NOT show');

$firephp->setEnabled(true);

if($firephp->getEnabled()) {
  $firephp->info('Enabled');
}

$firephp->fb('This should show');



if(FB::getEnabled()) {
  FB::info('Enabled');
}

FB::log('This should show');

FB::setEnabled(false);

if(!FB::getEnabled()) {
  FB::info('Disabled');
}

FB::send('This should NOT show');

FB::setEnabled(true);

if(FB::getEnabled()) {
  FB::info('Enabled');
}

FB::log('This should show');

