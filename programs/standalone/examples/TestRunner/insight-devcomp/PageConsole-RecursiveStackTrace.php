<?php

//Simple method to test FirePHP in tracing a recursive method.
function Create_Stack($source, $current_count, $max_count, $logger)
{
    //Allow for group names to be distinct.
    $current_group_name = 'Group_' . $source . '_' . $current_count;

    $logger->group($current_group_name)->open();
    $logger->info('Trace Method: Create_Stack()'); //Group Label
    
    $returned_count = $current_count;

    //Continue recursive call until current count matches max count.
    if ($current_count < $max_count) {

        //Create debug trace statement before recursive call.
        $logger->trace('Recursively Calling: Create_Stack() from ' . $source);

        //Make recursive call.
        $returned_count = Create_Stack($source, $current_count + 1, $max_count, $logger);
    }

    //Close up the current Group for the Current Stack.
    $logger->group($current_group_name)->close();

    //Only do this 1 time.
    if ( $current_count == 1 ) {
        //Demonstrate PHP Variable Scope and log output.
        $logger->log('isset($console): ' . ( isset( $console) ? 'true' : 'false'));
        $logger->log('isset($logger): ' .  ( isset( $logger ) ? 'true' : 'false'));

    }

    return $returned_count;
}

//Setup $console as FirePHPActivate
$console = FirePHP::to('page')->console('FirePHP_Activate');
$console = $console->option('encoder.maxObjectDepth', 1);

$console->info('First FirePHP Activated');

//Monitor / Track to see if each traced stack is displayed in DeveloperCompanion.
$logResult = Create_Stack('FirePHP.Activate.php', 0, 5, $console);

//Wrap it up....
$console->info('Finally :: Create_Stack() was called ' . $logResult . ' time(s)');
