<?php

namespace Poll\Controller;

use Poll\Model\Poll;

class PollFetch {

    public function getPoll(){
        $hash = $this->getHashParam();
        $poll = new Poll();
        return $poll->loadByHash($hash);
    }

    private function getHashParam(){
        return $_GET['p'];
    }
}