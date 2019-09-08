<?php
declare(strict_types=1);

class MyFirePHPWrapper2 extends FirePHP_TestWrapper {

    public function mytrace ($message) {
        return $this->trace($message);
    }
}
