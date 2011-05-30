<?php

$inspector = FirePHP::to('request'); 

for ($i=0,$ic=10 ; $i<$ic ; $i++)
{
    $eventName = 'TestEvent' . $i;

    for ($j=0,$jc=10 ; $j<$jc ; $j++)
    {
        $class = 'Class_Name_' . $j;
        
        $console = $inspector->console('Events')
                             ->on('Events')
                             ->label('Notified')
                             ->group('event-' . $eventName, sprintf('%s', $eventName));
        
        if ($console->on('Details')->is(true)) {
            $details = $console->group('event-' . $eventName . '-' . $class, sprintf('%s', $class))
                               ->options(array(
                                   'encoder.maxDepth' => 2
                               ));
            $details->label('$listener')->log('$listener');
            $details->label('$event')->log('$event');
        } else {
            $console->log(sprintf('%s', $class));
        }
    }
}

